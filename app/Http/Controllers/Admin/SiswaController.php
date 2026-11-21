<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $kelas = $request->get('kelas');
        
        $siswas = Siswa::when($search, function ($q) use ($search) {
            $q->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%");
            });
        })->when($kelas, function ($q) use ($kelas) {
            $q->where('kelas', $kelas);
        })->paginate(10);

        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        return redirect()->route('admin.siswa.index');
    }

    public function show(Siswa $siswa)
    {
        return redirect()->route('admin.siswa.index');
    }

    public function edit(Siswa $siswa)
    {
        return redirect()->route('admin.siswa.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'nullable|string|max:255',
            'kelas' => 'required|in:A,B',
            'kelas_id' => 'nullable|integer|exists:kelas,id',
            'jenis_kelamin' => 'required|in:L,P',
            'nama_ortu' => 'nullable|string|max:255',
            'no_hp_ortu' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        Siswa::create($validated);
        return redirect()->back()->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'nullable|string|max:255',
            'kelas' => 'required|in:A,B',
            'kelas_id' => 'nullable|integer|exists:kelas,id',
            'jenis_kelamin' => 'required|in:L,P',
            'nama_ortu' => 'nullable|string|max:255',
            'no_hp_ortu' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $siswa->update($validated);
        return redirect()->back()->with('success', 'Data siswa berhasil diupdate.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->back()->with('success', 'Data siswa berhasil dihapus.');
    }
}
