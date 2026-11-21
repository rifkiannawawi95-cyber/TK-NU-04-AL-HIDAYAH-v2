<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AcaraController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $query = Acara::orderBy('tanggal', 'desc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $acaras = $query->paginate(10)->withQueryString();
        $totalAcara = Acara::count();

        return view('admin.acara.index', compact('acaras', 'totalAcara', 'search'));
    }

    public function create()
    {
        return redirect()->route('admin.acara.index');
    }

    public function show(Acara $acara)
    {
        return redirect()->route('admin.acara.index');
    }

    public function edit(Acara $acara)
    {
        return redirect()->route('admin.acara.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'tanggal'   => 'required|date',
            'deskripsi' => 'required|string',
            'kategori'  => 'nullable|string|max:100',
            'lokasi'    => 'nullable|string|max:255',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, GIF, atau WEBP.',
            'foto.max'   => 'Ukuran foto maksimal adalah 5MB.',
        ]);

        $data = collect($validated)->only(['nama', 'tanggal', 'deskripsi', 'kategori', 'lokasi'])->all();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('acara', 'public');
            $data['foto'] = $path;
            $this->ensurePublicStorageMirror($path);
        }

        Acara::create($data);
        return redirect()->route('admin.acara.index')->with('success', 'Acara kegiatan berhasil ditambahkan.');
    }

    public function update(Request $request, Acara $acara)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'tanggal'   => 'required|date',
            'deskripsi' => 'required|string',
            'kategori'  => 'nullable|string|max:100',
            'lokasi'    => 'nullable|string|max:255',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format gambar harus JPEG, PNG, JPG, GIF, atau WEBP.',
            'foto.max'   => 'Ukuran foto maksimal adalah 5MB.',
        ]);

        $data = collect($validated)->only(['nama', 'tanggal', 'deskripsi', 'kategori', 'lokasi'])->all();

        if ($request->hasFile('foto')) {
            $this->deletePhysicalFile($acara->foto);
            $path = $request->file('foto')->store('acara', 'public');
            $data['foto'] = $path;
            $this->ensurePublicStorageMirror($path);
        }

        $acara->update($data);
        return redirect()->route('admin.acara.index')->with('success', 'Acara kegiatan berhasil diperbarui.');
    }

    public function destroy(Acara $acara)
    {
        $this->deletePhysicalFile($acara->foto);
        $acara->delete();
        return redirect()->route('admin.acara.index')->with('success', 'Acara kegiatan berhasil dihapus.');
    }

    /**
     * Memastikan file dari storage/app/public/ juga tersedia di public/storage/
     */
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
            \Illuminate\Support\Facades\Log::warning('Mirror storage acara failed: ' . $e->getMessage());
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
