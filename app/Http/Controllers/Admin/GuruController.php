<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $gurus = Guru::when($search, function($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return redirect()->route('admin.guru.index');
    }

    public function show(Guru $guru)
    {
        return redirect()->route('admin.guru.index');
    }

    public function edit(Guru $guru)
    {
        return redirect()->route('admin.guru.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'jabatan' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'is_active' => 'nullable|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        $data = $request->only(['nama', 'nip', 'jabatan', 'no_hp']);
        $data['is_active'] = $request->has('is_active') ? (bool) $request->input('is_active') : true;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('gurus', 'public');
        }

        Guru::create($data);
        return redirect()->back()->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function update(Request $request, Guru $guru)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:255',
            'jabatan' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:15',
            'is_active' => 'nullable|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        $data = $request->only(['nama', 'nip', 'jabatan', 'no_hp']);
        if ($request->has('is_active')) {
            $data['is_active'] = (bool) $request->input('is_active');
        }

        if ($request->hasFile('foto')) {
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }
            $data['foto'] = $request->file('foto')->store('gurus', 'public');
        }

        $guru->update($data);
        return redirect()->back()->with('success', 'Data guru berhasil diupdate.');
    }

    public function destroy(Guru $guru)
    {
        if ($guru->foto) {
            Storage::disk('public')->delete($guru->foto);
        }
        $guru->delete();
        return redirect()->back()->with('success', 'Data guru berhasil dihapus.');
    }
}
