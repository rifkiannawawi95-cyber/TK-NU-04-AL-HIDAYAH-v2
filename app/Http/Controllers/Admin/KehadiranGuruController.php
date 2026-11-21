<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\KehadiranGuru;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KehadiranGuruController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'nullable|date_format:Y-m-d',
        ]);

        $tanggal = $validated['tanggal'] ?? date('Y-m-d');

        $gurus = Guru::where('is_active', true)->get();
        $kehadirans = KehadiranGuru::with('guru')->where('tanggal', $tanggal)->get()->keyBy('guru_id');

        return view('admin.kehadiranguru.index', compact('gurus', 'kehadirans', 'tanggal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date_format:Y-m-d',
            'status' => 'required|array',
            'status.*' => ['nullable', Rule::in(['Hadir', 'Izin', 'Sakit', 'Alpa'])],
            'keterangan' => 'nullable|array',
            'keterangan.*' => 'nullable|string|max:255',
        ]);

        $tanggal = $validated['tanggal'];
        $status = $validated['status'];
        $keterangan = $validated['keterangan'] ?? [];

        $allowedGuruIds = Guru::where('is_active', true)
            ->whereIn('id', array_keys($status))
            ->pluck('id')
            ->all();

        foreach ($allowedGuruIds as $guruId) {
            $stat = $status[$guruId] ?? null;
            if ($stat) {
                KehadiranGuru::updateOrCreate(
                    ['guru_id' => $guruId, 'tanggal' => $tanggal],
                    ['status' => $stat, 'keterangan' => $keterangan[$guruId] ?? null]
                );
            }
        }

        return redirect()->back()->with('success', 'Kehadiran berhasil disimpan.');
    }

    public function rekap(Request $request)
    {
        $validated = $request->validate([
            'bulan' => 'nullable|integer|between:1,12',
            'tahun' => 'nullable|integer|between:2000,2100',
        ]);

        $bulan = (int) ($validated['bulan'] ?? date('m'));
        $tahun = (int) ($validated['tahun'] ?? date('Y'));

        $gurus = Guru::with(['kehadiran' => function ($q) use ($bulan, $tahun) {
            $q->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();

        return view('admin.kehadiranguru.rekap', compact('gurus', 'bulan', 'tahun'));
    }
}
