<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\KehadiranSiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswaA = Siswa::where('kelas', 'A')->count();
        $totalSiswaB = Siswa::where('kelas', 'B')->count();

        $today = Carbon::today()->format('Y-m-d');
        
        $hadirHariIni = KehadiranSiswa::where('tanggal', $today)->where('status', 'Hadir')->count();
        $izinHariIni = KehadiranSiswa::where('tanggal', $today)->where('status', 'Izin')->count();
        $sakitHariIni = KehadiranSiswa::where('tanggal', $today)->where('status', 'Sakit')->count();
        $alpaHariIni = KehadiranSiswa::where('tanggal', $today)->where('status', 'Alpa')->count();

        return view('user.dashboard', compact(
            'totalSiswaA', 'totalSiswaB', 'hadirHariIni', 'izinHariIni', 'sakitHariIni', 'alpaHariIni'
        ));
    }
}
