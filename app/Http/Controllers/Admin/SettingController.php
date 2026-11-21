<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\SchoolSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SchoolSetting::getAllSettings();
        $gurus = Guru::where('is_active', true)->orderBy('nama')->get();

        return view('admin.setting.index', compact('settings', 'gurus'));
    }

    public function updateSchool(Request $request)
    {
        $request->validate([
            'nama_sekolah'    => 'required|string|max:255',
            'nama_yayasan'    => 'nullable|string|max:255',
            'kepala_sekolah'  => 'nullable|string|max:255',
            'alamat'          => 'nullable|string',
            'telepon'         => 'nullable|string|max:20',
            'email'           => 'nullable|email|max:255',
            'visi'            => 'nullable|string',
            'misi'            => 'nullable|string',
            'tujuan'          => 'nullable|string',
        ]);

        $keys = ['nama_sekolah', 'nama_yayasan', 'kepala_sekolah', 'alamat', 'telepon', 'email', 'visi', 'misi', 'tujuan'];

        foreach ($keys as $key) {
            SchoolSetting::set($key, $request->input($key));
        }

        return redirect()->back()->with('success', 'Profil sekolah berhasil diperbarui.');
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Delete old logo if stored in storage (not the default one)
        $oldLogo = SchoolSetting::get('logo_path');
        if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
            Storage::disk('public')->delete($oldLogo);
        }

        $path = $request->file('logo')->store('settings', 'public');
        SchoolSetting::set('logo_path', $path);

        return redirect()->back()->with('success', 'Logo sekolah berhasil diperbarui.');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'key'   => 'required|string|in:hero_image,school_image,kepala_sekolah_photo,logo_maarif,logo_path',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        $key = $request->input('key');

        // Delete previous uploaded photo if exists in storage
        $oldPhoto = SchoolSetting::get($key);
        if ($oldPhoto && Storage::disk('public')->exists($oldPhoto)) {
            Storage::disk('public')->delete($oldPhoto);
        }

        $path = $request->file('photo')->store('settings', 'public');
        SchoolSetting::set($key, $path);

        $labels = [
            'hero_image'           => 'Foto Banner Beranda',
            'school_image'         => 'Foto Gedung Sekolah',
            'kepala_sekolah_photo' => 'Foto Kepala Sekolah',
            'logo_maarif'          => 'Logo LP Ma\'arif / Yayasan',
            'logo_path'            => 'Logo Sekolah',
        ];

        $label = $labels[$key] ?? 'Foto';

        return redirect()->back()->with('success', "{$label} berhasil diperbarui.");
    }

    public function resetPhoto($key)
    {
        $allowed = ['hero_image', 'school_image', 'kepala_sekolah_photo', 'logo_maarif', 'logo_path'];
        if (!in_array($key, $allowed)) {
            return redirect()->back()->with('error', 'Kunci foto tidak dikenali.');
        }

        $oldPhoto = SchoolSetting::get($key);
        if ($oldPhoto && Storage::disk('public')->exists($oldPhoto)) {
            Storage::disk('public')->delete($oldPhoto);
        }

        SchoolSetting::set($key, null);

        $labels = [
            'hero_image'           => 'Foto Banner Beranda',
            'school_image'         => 'Foto Gedung Sekolah',
            'kepala_sekolah_photo' => 'Foto Kepala Sekolah',
            'logo_maarif'          => 'Logo LP Ma\'arif / Yayasan',
            'logo_path'            => 'Logo Sekolah',
        ];

        $label = $labels[$key] ?? 'Foto';

        return redirect()->back()->with('success', "{$label} berhasil dikembalikan ke default bawaan.");
    }

    public function updateGuru(Request $request, Guru $guru)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'nip'     => 'nullable|string|max:50',
            'jabatan' => 'required|string|max:255',
            'no_hp'   => 'nullable|string|max:20',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['nama', 'nip', 'jabatan', 'no_hp']);

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('gurus', 'public');
        }

        $guru->update($data);

        return redirect()->back()->with('success', 'Data guru berhasil diperbarui.');
    }
}
