@extends('layouts.public')
@section('title', 'Kalender & Agenda - TK NU 04 SITUBONDO')
@section('content')

<!-- Header Banner -->
<div class="bg-gradient-to-b from-[#eaf6ed] via-[#f0fdf4] to-white py-12 lg:py-16 border-b border-emerald-100/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 bg-emerald-100/80 border border-emerald-200/60 px-4 py-1.5 rounded-full text-[#0f3c2b] text-xs font-bold tracking-wide mb-4">
            <i class="fas fa-calendar-check text-emerald-600"></i> Kalender Akademik
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#0f3c2b] tracking-tight mb-4">
            Jadwal & Agenda Sekolah
        </h1>
        <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto font-medium">
            Jadwal kegiatan pembelajaran, penilaian perkembangan santri, dan hari libur resmi TK NU 04 SITUBONDO.
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Category Filter Indicator -->
    <div class="flex items-center justify-center gap-3 mb-8 flex-wrap text-xs font-bold" data-aos="fade-up">
        <span class="px-3.5 py-1.5 rounded-full bg-emerald-100 text-emerald-800 flex items-center gap-1.5 shadow-xs">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Kegiatan Sekolah
        </span>
        <span class="px-3.5 py-1.5 rounded-full bg-amber-100 text-amber-800 flex items-center gap-1.5 shadow-xs">
            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Evaluasi / Ujian
        </span>
        <span class="px-3.5 py-1.5 rounded-full bg-rose-100 text-rose-800 flex items-center gap-1.5 shadow-xs">
            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Hari Libur
        </span>
    </div>

    <!-- Super Minimalist Agenda Vertical Timeline -->
    <div class="space-y-4" data-aos="fade-up">
        @forelse($kalenders as $kalender)
            @php
                $isLibur = strtolower($kalender->jenis) == 'libur';
                $isUjian = strtolower($kalender->jenis) == 'ujian';
                $badgeBg = $isLibur ? 'bg-rose-50 text-rose-700 border-rose-200' : ($isUjian ? 'bg-amber-50 text-amber-800 border-amber-200' : 'bg-emerald-50 text-emerald-800 border-emerald-200');
                $dateBg = $isLibur ? 'bg-rose-600 text-white' : ($isUjian ? 'bg-amber-500 text-white' : 'bg-emerald-600 text-white');
            @endphp

            <div class="bg-white rounded-3xl p-5 sm:p-6 shadow-sm hover:shadow-xl border border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 transition-all duration-300 group">
                
                <div class="flex items-start sm:items-center gap-4 flex-1">
                    <!-- Date Badge (Day + Month) -->
                    <div class="w-14 h-14 rounded-2xl {{ $dateBg }} flex flex-col items-center justify-center flex-shrink-0 font-black shadow-md leading-none group-hover:scale-105 transition-transform">
                        <span class="text-base">{{ \Carbon\Carbon::parse($kalender->tanggal_mulai)->format('d') }}</span>
                        <span class="text-[10px] font-bold uppercase mt-0.5 opacity-90">{{ \Carbon\Carbon::parse($kalender->tanggal_mulai)->format('M') }}</span>
                    </div>

                    <!-- Title & Details -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-base sm:text-lg font-black text-gray-900 group-hover:text-emerald-700 transition-colors leading-snug">
                                {{ $kalender->nama_kegiatan }}
                            </h3>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider border {{ $badgeBg }}">
                                {{ $kalender->jenis }}
                            </span>
                        </div>

                        <div class="flex items-center gap-3 mt-1.5 text-xs text-gray-500 font-semibold flex-wrap">
                            <span class="flex items-center gap-1.5">
                                <i class="far fa-clock text-emerald-600"></i>
                                {{ \Carbon\Carbon::parse($kalender->tanggal_mulai)->translatedFormat('d F Y') }}
                                @if($kalender->tanggal_selesai && $kalender->tanggal_mulai != $kalender->tanggal_selesai)
                                    s/d {{ \Carbon\Carbon::parse($kalender->tanggal_selesai)->translatedFormat('d F Y') }}
                                @endif
                            </span>
                            <span class="text-gray-300">&bull;</span>
                            <span class="flex items-center gap-1 text-gray-600">
                                <i class="fas fa-location-dot text-rose-500 text-xs"></i> Gedung TK NU 04
                            </span>
                        </div>
                    </div>
                </div>

                <div class="self-end sm:self-center">
                    <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-100 flex items-center gap-1">
                        <i class="fas fa-bell text-[10px]"></i> Terjadwal
                    </span>
                </div>

            </div>
        @empty
            <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl mx-auto mb-3">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Belum Ada Agenda Terjadwal</h3>
                <p class="text-xs text-gray-500 mt-1">Data kalender akademik akan segera diperbarui oleh pihak sekolah.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
