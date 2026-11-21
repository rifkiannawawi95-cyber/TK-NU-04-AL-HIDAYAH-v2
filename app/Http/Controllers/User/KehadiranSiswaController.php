<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\KehadiranSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KehadiranSiswaController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'nullable|date_format:Y-m-d',
            'kelas' => 'nullable|in:A,B',
        ]);

        $tanggal = $validated['tanggal'] ?? date('Y-m-d');
        $kelas = $validated['kelas'] ?? 'A';

        $siswas = Siswa::where('kelas', $kelas)->where('is_active', true)->get();
        $kehadirans = KehadiranSiswa::where('tanggal', $tanggal)
            ->whereIn('siswa_id', $siswas->pluck('id'))
            ->get()->keyBy('siswa_id');

        return view('user.kehadiransiswa.index', compact('siswas', 'kehadirans', 'tanggal', 'kelas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date_format:Y-m-d',
            'kelas' => 'required|in:A,B',
            'status' => 'nullable|array',
            'status.*' => ['nullable', Rule::in(['Hadir', 'Izin', 'Sakit', 'Alpa'])],
            'keterangan' => 'nullable|array',
            'keterangan.*' => 'nullable|string|max:255',
        ]);

        $tanggal = $validated['tanggal'];
        $kelas = $validated['kelas'];
        $status = $validated['status'] ?? [];
        $keterangan = $validated['keterangan'] ?? [];

        if (!empty($status)) {
            $allowedSiswaIds = Siswa::where('kelas', $kelas)
                ->where('is_active', true)
                ->whereIn('id', array_keys($status))
                ->pluck('id')
                ->all();

            foreach ($allowedSiswaIds as $siswaId) {
                $stat = $status[$siswaId] ?? null;
                if ($stat) {
                    KehadiranSiswa::updateOrCreate(
                        ['siswa_id' => $siswaId, 'tanggal' => $tanggal],
                        ['status' => $stat, 'keterangan' => $keterangan[$siswaId] ?? null]
                    );
                }
            }
        }

        return redirect()->back()->with('success', 'Kehadiran siswa berhasil disimpan.');
    }

    public function rekap(Request $request)
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

        return view('user.kehadiransiswa.rekap', compact('siswas', 'bulan', 'tahun', 'kelas'));
    }
}
