<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acara;
use App\Models\Galeri;
use App\Models\Guru;
use App\Models\KalenderAkademik;
use App\Models\KehadiranGuru;
use App\Models\Prestasi;
use App\Models\SchoolSetting;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->format('Y-m-d');
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        // 1. Stat Utama Siswa & Guru
        $totalSiswa = Siswa::count();
        $siswaAktif = Siswa::where('is_active', true)->count();
        $siswaLaki = Siswa::where('jenis_kelamin', 'L')->count();
        $siswaPerempuan = Siswa::where('jenis_kelamin', 'P')->count();

        $totalGuru = Guru::count();
        $guruAktif = Guru::where('is_active', true)->count();

        // 2. Galeri Foto Kegiatan
        $totalGaleri = Galeri::count();
        $galeriTerbaru = Galeri::latest()->take(6)->get();

        // 3. Acara & Kalender Mendatang
        $totalAcara = Acara::count();
        $totalPrestasi = Prestasi::count();

        $upcomingAcara = Acara::where('tanggal', '>=', $today)
            ->orderBy('tanggal', 'asc')
            ->take(3)
            ->get();

        $upcomingKalender = KalenderAkademik::where('tanggal_mulai', '>=', $today)
            ->orderBy('tanggal_mulai', 'asc')
            ->take(3)
            ->get();

        $acaraMendatangCount = Acara::where('tanggal', '>=', $today)->count()
            + KalenderAkademik::where('tanggal_mulai', '>=', $today)->count();

        // 4. Presensi Guru Hari Ini & Rekap Gaji/Potongan
        $hadirHariIni = KehadiranGuru::where('tanggal', $today)->where('status', 'Hadir')->count();
        $tidakHadirHariIni = KehadiranGuru::where('tanggal', $today)->whereIn('status', ['Izin', 'Sakit', 'Alpa'])->count();

        $totalAlpaBulanIni = KehadiranGuru::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)
            ->whereIn('status', ['Izin', 'Sakit', 'Alpa'])
            ->count();
        $totalPotongan = $totalAlpaBulanIni * 5000;

        $kehadiranTerbaru = KehadiranGuru::with('guru')->latest()->take(5)->get();

        $alamatSekolah = SchoolSetting::get('alamat', '82H9+7FV, Jl. Raya Olean, Olean Tengah, Olean, Kec. Situbondo, Kabupaten Situbondo, Jawa Timur 68316');

        return view('admin.dashboard', compact(
            'totalSiswa',
            'siswaAktif',
            'siswaLaki',
            'siswaPerempuan',
            'totalGuru',
            'guruAktif',
            'totalGaleri',
            'galeriTerbaru',
            'totalAcara',
            'totalPrestasi',
            'acaraMendatangCount',
            'upcomingAcara',
            'upcomingKalender',
            'hadirHariIni',
            'tidakHadirHariIni',
            'totalPotongan',
            'kehadiranTerbaru',
            'alamatSekolah'
        ));
    }

    /**
     * Update alamat lengkap sekolah di website publik langsung dari dashboard admin.
     */
    public function updateAddress(Request $request)
    {
        $validated = $request->validate([
            'alamat' => 'required|string|max:1000',
        ], [
            'alamat.required' => 'Alamat lengkap sekolah tidak boleh kosong.',
            'alamat.max'      => 'Alamat maksimal 1000 karakter.',
        ]);

        SchoolSetting::set('alamat', trim($validated['alamat']));

        return redirect()->back()->with('success', 'Alamat lengkap sekolah di website publik berhasil diperbarui.');
    }
}
