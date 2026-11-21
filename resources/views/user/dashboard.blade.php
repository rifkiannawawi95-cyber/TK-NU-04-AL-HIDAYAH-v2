@extends('layouts.admin')
@section('title', 'Guru Dashboard')
@section('header', 'Dashboard Guru')
@section('content')

<!-- Welcome Banner Card with Logo NU -->
<div class="bg-gradient-to-r from-green-900 via-green-800 to-emerald-900 rounded-2xl p-6 sm:p-7 text-white mb-8 shadow-md border border-green-700/40 flex flex-col sm:flex-row sm:items-center justify-between gap-6 relative overflow-hidden">
    <div class="absolute -right-10 -bottom-10 w-44 h-44 bg-green-500/10 rounded-full blur-2xl pointer-events-none"></div>
    <div class="flex items-center gap-4 relative z-10">
        <img src="{{ \App\Models\SchoolSetting::get('logo_path') ? Storage::url(\App\Models\SchoolSetting::get('logo_path')) : asset('images/logo-nu.png') }}" alt="Logo NU TK AL-HIDAYAH" class="w-16 h-16 sm:w-20 sm:h-20 object-contain rounded-2xl shadow p-1 bg-white flex-shrink-0">
        <div>
            <span class="inline-block px-3 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-emerald-400 text-gray-950 mb-1.5">
                YAYASAN LP MA'ARIF NU CABANG SITUBONDO
            </span>
            <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight">TK NU 04 AL-HIDAYAH SITUBONDO</h2>
            <p class="text-xs sm:text-sm text-green-200 mt-0.5">Portal Guru & Presensi Belajar</p>
        </div>
    </div>
    <div class="sm:text-right relative z-10">
        <p class="text-xs text-green-300 font-medium">Masuk Sebagai</p>
        <p class="text-sm font-bold text-white">{{ auth()->user()->name }}</p>
        <span class="inline-block mt-1 text-[11px] font-semibold text-emerald-300 bg-emerald-950/60 px-2.5 py-0.5 rounded-full border border-emerald-700/50">
            Tenaga Pendidik / Guru
        </span>
    </div>
</div>

<!-- Quick Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Siswa Kelas A</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalSiswaA }}</h3>
            <span class="inline-block mt-2 text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">Kelompok A</span>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl shadow-inner">
            <i class="fas fa-users"></i>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Siswa Kelas B</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $totalSiswaB }}</h3>
            <span class="inline-block mt-2 text-xs font-semibold text-purple-600 bg-purple-50 px-2 py-0.5 rounded-md">Kelompok B</span>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl shadow-inner">
            <i class="fas fa-users"></i>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Hadir Hari Ini</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $hadirHariIni }}</h3>
            <span class="inline-block mt-2 text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-md">Presensi Masuk</span>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl shadow-inner">
            <i class="fas fa-check-circle"></i>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
        <div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Absen Hari Ini</p>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-1">{{ $izinHariIni + $sakitHariIni + $alpaHariIni }}</h3>
            <span class="inline-block mt-2 text-xs font-semibold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-md">Izin / Sakit / Alpa</span>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center text-2xl shadow-inner">
            <i class="fas fa-times-circle"></i>
        </div>
    </div>
</div>

<!-- Quick Action & Detail Section -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <div class="lg:col-span-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
            <i class="fas fa-th-large text-green-600"></i> Aksi Cepat Guru
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ route('user.kehadiransiswa.index') }}" class="p-5 rounded-2xl bg-green-50 hover:bg-green-100 text-green-900 font-bold text-sm flex flex-col items-center justify-center text-center gap-2 border border-green-200/60 transition-all hover:shadow">
                <i class="fas fa-calendar-check text-2xl text-green-700"></i> Input Kehadiran Siswa
            </a>
            <a href="{{ route('user.siswa.index') }}" class="p-5 rounded-2xl bg-blue-50 hover:bg-blue-100 text-blue-900 font-bold text-sm flex flex-col items-center justify-center text-center gap-2 border border-blue-200/60 transition-all hover:shadow">
                <i class="fas fa-child text-2xl text-blue-700"></i> Kelola Data Siswa
            </a>
            <a href="{{ route('user.kehadiransiswa.rekap') }}" class="p-5 rounded-2xl bg-purple-50 hover:bg-purple-100 text-purple-900 font-bold text-sm flex flex-col items-center justify-center text-center gap-2 border border-purple-200/60 transition-all hover:shadow">
                <i class="fas fa-file-alt text-2xl text-purple-700"></i> Rekap & Cetak Laporan
            </a>
        </div>
    </div>

    <div class="lg:col-span-4 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
            <i class="fas fa-chart-bar text-yellow-600"></i> Rincian Ketidakhadiran
        </h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 rounded-xl bg-yellow-50/80 border border-yellow-100">
                <span class="text-xs font-bold text-yellow-800 flex items-center gap-2">
                    <i class="fas fa-info-circle"></i> Izin
                </span>
                <span class="text-lg font-extrabold text-yellow-900">{{ $izinHariIni }}</span>
            </div>

            <div class="flex items-center justify-between p-3 rounded-xl bg-orange-50/80 border border-orange-100">
                <span class="text-xs font-bold text-orange-800 flex items-center gap-2">
                    <i class="fas fa-notes-medical"></i> Sakit
                </span>
                <span class="text-lg font-extrabold text-orange-900">{{ $sakitHariIni }}</span>
            </div>

            <div class="flex items-center justify-between p-3 rounded-xl bg-rose-50/80 border border-rose-100">
                <span class="text-xs font-bold text-rose-800 flex items-center gap-2">
                    <i class="fas fa-user-slash"></i> Alpa
                </span>
                <span class="text-lg font-extrabold text-rose-900">{{ $alpaHariIni }}</span>
            </div>
        </div>
    </div>
</div>

@endsection

