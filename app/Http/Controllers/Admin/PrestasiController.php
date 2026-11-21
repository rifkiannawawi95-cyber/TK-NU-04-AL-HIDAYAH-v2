<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $query = Prestasi::orderBy('tanggal', 'desc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_siswa', 'like', "%{$search}%")
                  ->orWhere('nama_lomba', 'like', "%{$search}%")
                  ->orWhere('juara', 'like', "%{$search}%")
                  ->orWhere('tingkat', 'like', "%{$search}%");
            });
        }

        $prestasis = $query->paginate(10)->withQueryString();
        $totalPrestasi = Prestasi::count();

        return view('admin.prestasi.index', compact('prestasis', 'totalPrestasi', 'search'));
    }

    public function create()
    {
        return redirect()->route('admin.prestasi.index');
    }

    public function show(Prestasi $prestasi)
    {
        return redirect()->route('admin.prestasi.index');
    }

    public function edit(Prestasi $prestasi)
    {
        return redirect()->route('admin.prestasi.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas'      => 'required|in:A,B',
            'nama_lomba' => 'required|string|max:255',
            'juara'      => 'required|string|max:100',
            'tingkat'    => 'nullable|string|max:100',
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable|string',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, GIF, atau WEBP.',
            'foto.max'   => 'Ukuran foto maksimal adalah 5MB.',
        ]);

        $data = collect($validated)->only(['nama_siswa', 'kelas', 'nama_lomba', 'tingkat', 'juara', 'tanggal', 'keterangan'])->all();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('prestasi', 'public');
            $data['foto'] = $path;
            $this->ensurePublicStorageMirror($path);
        }

        Prestasi::create($data);
        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi santri berhasil ditambahkan.');
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas'      => 'required|in:A,B',
            'nama_lomba' => 'required|string|max:255',
            'juara'      => 'required|string|max:100',
            'tingkat'    => 'nullable|string|max:100',
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable|string',
            'foto'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, GIF, atau WEBP.',
            'foto.max'   => 'Ukuran foto maksimal adalah 5MB.',
        ]);

        $data = collect($validated)->only(['nama_siswa', 'kelas', 'nama_lomba', 'tingkat', 'juara', 'tanggal', 'keterangan'])->all();

        if ($request->hasFile('foto')) {
            $this->deletePhysicalFile($prestasi->foto);
            $path = $request->file('foto')->store('prestasi', 'public');
            $data['foto'] = $path;
            $this->ensurePublicStorageMirror($path);
        }

        $prestasi->update($data);
        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi santri berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi)
    {
        $this->deletePhysicalFile($prestasi->foto);
        $prestasi->delete();
        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi berhasil dihapus.');
    }

    protected function ensurePublicStorageMirror(string $storageRelativePath): void
    {
        try {
            $sourcePath = storage_path('app/public/' . $storageRelativePath);
            $targetPath = public_path('storage/' . $storageRelativePath);

            if (is_link(public_path('storage'))) {
                return;
            }

            $targetDir = dirname($targetPath);
            if (!File::isDirectory($targetDir)) {
                File::makeDirectory($targetDir, 0755, true, true);
            }

            if (File::exists($sourcePath) && !File::exists($targetPath)) {
                File::copy($sourcePath, $targetPath);
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('Mirror storage prestasi failed: ' . $e->getMessage());
        }
    }

    protected function deletePhysicalFile(?string $fotoPath): void
    {
        if (empty($fotoPath)) {
            return;
        }

        $clean = ltrim(trim($fotoPath), '/\\');

        if (str_starts_with($clean, 'http://') || str_starts_with($clean, 'https://')) {
            return;
        }

        if (Storage::disk('public')->exists($clean)) {
            Storage::disk('public')->delete($clean);
        }

        if (File::exists(public_path('storage/' . $clean))) {
            @unlink(public_path('storage/' . $clean));
        }

        if (File::exists(public_path($clean))) {
            @unlink(public_path($clean));
        }
    }
}
