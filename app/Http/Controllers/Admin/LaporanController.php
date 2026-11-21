<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function guru(Request $request)
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

        return view('admin.laporan.guru', compact('gurus', 'bulan', 'tahun'));
    }

    public function siswa(Request $request)
    {
        $validated = $request->validate([
            'bulan' => 'nullable|integer|between:1,12',
            'tahun' => 'nullable|integer|between:2000,2100',
            'kelas' => 'nullable|in:A,B',
        ]);

        $bulan = (int) ($validated['bulan'] ?? date('m'));
        $tahun = (int) ($validated['tahun'] ?? date('Y'));
        $kelas = $validated['kelas'] ?? 'A';

        $siswas = Siswa::where('kelas', $kelas)->with(['kehadiran' => function ($q) use ($bulan, $tahun) {
            $q->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }])->get();

        return view('admin.laporan.siswa', compact('siswas', 'bulan', 'tahun', 'kelas'));
    }
}
