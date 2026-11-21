<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use Illuminate\Http\Request;

class KalenderController extends Controller
{
    public function index()
    {
        $kalenders = KalenderAkademik::orderBy('tanggal_mulai', 'asc')->paginate(15);
        return view('admin.kalender.index', compact('kalenders'));
    }

    public function create()
    {
        return redirect()->route('admin.kalender.index');
    }

    public function show(KalenderAkademik $kalender)
    {
        return redirect()->route('admin.kalender.index');
    }

    public function edit(KalenderAkademik $kalender)
    {
        return redirect()->route('admin.kalender.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jenis' => 'nullable|string|max:255',
        ]);

        KalenderAkademik::create($validated);
        return redirect()->back()->with('success', 'Agenda kalender berhasil ditambahkan.');
    }

    public function update(Request $request, KalenderAkademik $kalender)
    {
        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jenis' => 'nullable|string|max:255',
        ]);

        $kalender->update($validated);
        return redirect()->back()->with('success', 'Agenda kalender berhasil diupdate.');
    }

    public function destroy(KalenderAkademik $kalender)
    {
        $kalender->delete();
        return redirect()->back()->with('success', 'Agenda kalender berhasil dihapus.');
    }
}
