<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Menampilkan daftar galeri dengan fitur pencarian & filter kategori.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $kategori = $request->get('kategori');

        $query = Galeri::latest();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        if (!empty($kategori) && $kategori !== 'Semua') {
            $query->where('kategori', $kategori);
        }

        $galeris = $query->paginate(12)->withQueryString();

        $daftarKategori = Galeri::whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->pluck('kategori');

        $totalFoto = Galeri::count();

        return view('admin.galeri.index', compact('galeris', 'daftarKategori', 'totalFoto', 'search', 'kategori'));
    }

    /**
     * Tampilan form tambah galeri (diarahkan ke form index).
     */
    public function create()
    {
        return redirect()->route('admin.galeri.index');
    }

    /**
     * Tampilan detail galeri.
     */
    public function show(Galeri $galeri)
    {
        return redirect()->route('admin.galeri.index');
    }

    /**
     * Tampilan edit galeri.
     */
    public function edit(Galeri $galeri)
    {
        return redirect()->route('admin.galeri.index');
    }

    /**
     * Menyimpan foto galeri baru ke disk public (storage/app/public/galeri).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'    => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'foto'     => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'foto.required' => 'File foto wajib dipilih.',
            'foto.image'    => 'File harus berupa gambar.',
            'foto.mimes'    => 'Format gambar harus JPEG, PNG, JPG, GIF, atau WEBP.',
            'foto.max'      => 'Ukuran foto maksimal adalah 5MB.',
        ]);

        $data = [
            'judul'    => $validated['judul'] ?? null,
            'kategori' => $validated['kategori'] ?? 'Kegiatan',
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            
            // Simpan ke storage/app/public/galeri
            $path = $file->store('galeri', 'public');
            $data['foto'] = $path;

            // Pastikan direktori public/storage/galeri ada dan file sinkron (dukungan Windows/Laragon tanpa symlink)
            $this->ensurePublicStorageMirror($path);
        }

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil diunggah.');
    }

    /**
     * Memperbarui informasi foto galeri (judul, kategori, atau mengganti file foto).
     */
    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul'    => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, GIF, atau WEBP.',
            'foto.max'   => 'Ukuran foto maksimal adalah 5MB.',
        ]);

        $data = [
            'judul'    => $validated['judul'] ?? null,
            'kategori' => $validated['kategori'] ?? 'Kegiatan',
        ];

        if ($request->hasFile('foto')) {
            // Hapus file lama jika ada
            $this->deletePhysicalFile($galeri->foto);

            // Simpan file foto baru
            $path = $request->file('foto')->store('galeri', 'public');
            $data['foto'] = $path;

            $this->ensurePublicStorageMirror($path);
        }

        $galeri->update($data);

        return redirect()->back()->with('success', 'Foto galeri berhasil diperbarui.');
    }

    /**
     * Menghapus foto galeri beserta file fisik dari media storage.
     */
    public function destroy(Galeri $galeri)
    {
        $this->deletePhysicalFile($galeri->foto);
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil dihapus.');
    }

    /**
     * Memastikan file dari storage/app/public/ juga tersedia di public/storage/
     * jika lingkungan Windows belum menjalankan atau tidak mendukung native junction symlink.
     */
    protected function ensurePublicStorageMirror(string $storageRelativePath): void
    {
        try {
            $sourcePath = storage_path('app/public/' . $storageRelativePath);
            $targetPath = public_path('storage/' . $storageRelativePath);

            // Jika public/storage adalah symlink asli ke storage/app/public, maka tidak perlu copy manual
            if (is_link(public_path('storage'))) {
                return;
            }

            // Jika bukan symlink atau berupa direct folder, mirror file agar URL asset('storage/...') langsung dapat diakses
            $targetDir = dirname($targetPath);
            if (!File::isDirectory($targetDir)) {
                File::makeDirectory($targetDir, 0755, true, true);
            }

            if (File::exists($sourcePath) && !File::exists($targetPath)) {
                File::copy($sourcePath, $targetPath);
            }
        } catch (\Throwable $e) {
            // Log secara aman dan lanjutkan eksekusi
            \Illuminate\Support\Facades\Log::warning('Mirror storage file failed: ' . $e->getMessage());
        }
    }

    /**
     * Helper pembersih file fisik dari berbagai kemungkinan lokasi penyimpanan.
     */
    protected function deletePhysicalFile(?string $fotoPath): void
    {
        if (empty($fotoPath)) {
            return;
        }

        $clean = ltrim(trim($fotoPath), '/\\');

        if (str_starts_with($clean, 'http://') || str_starts_with($clean, 'https://')) {
            return;
        }

        // Hapus dari disk public
        if (Storage::disk('public')->exists($clean)) {
            Storage::disk('public')->delete($clean);
        }

        // Hapus dari public/storage/ jika ada
        if (File::exists(public_path('storage/' . $clean))) {
            @unlink(public_path('storage/' . $clean));
        }

        // Hapus dari public/ jika format lama
        if (File::exists(public_path($clean))) {
            @unlink(public_path($clean));
        }
    }
}
