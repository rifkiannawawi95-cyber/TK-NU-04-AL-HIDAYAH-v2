@extends('layouts.public')
@section('title', 'Prestasi Santri - TK NU 04 SITUBONDO')
@section('content')

<!-- Header Banner -->
<div class="bg-gradient-to-b from-[#eaf6ed] via-[#f0fdf4] to-white py-12 lg:py-16 border-b border-emerald-100/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 bg-amber-100/80 border border-amber-200/60 px-4 py-1.5 rounded-full text-amber-900 text-xs font-bold tracking-wide mb-4">
            <i class="fas fa-trophy text-amber-500"></i> Kebanggaan & Kejuaraan
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#0f3c2b] tracking-tight mb-4">
            Prestasi Anak Didik
        </h1>
        <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto font-medium">
            Apresiasi atas bakat, daya juang, dan pencapaian membanggakan siswa-siswi cilik TK NU 04 SITUBONDO.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($prestasis as $index => $prestasi)
            <div class="bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col justify-between group" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                
                <div class="p-6 sm:p-7 text-center relative overflow-hidden flex flex-col items-center">
                    <!-- Subtle Glow -->
                    <div class="absolute -top-12 -right-12 w-36 h-36 bg-amber-100/50 rounded-full blur-2xl pointer-events-none"></div>
                    
                    <!-- Student Photo / Trophy Badge Container -->
                    <div class="relative w-28 h-28 mx-auto mb-4 group-hover:scale-105 transition-transform duration-300">
                        <img src="{{ $prestasi->foto_url }}" 
                             alt="{{ $prestasi->nama_siswa }}" 
                             class="w-full h-full object-cover rounded-3xl shadow-md border-4 border-white ring-2 ring-amber-300"
                             loading="lazy"
                             onerror="this.onerror=null;this.src='{{ asset('images/default-prestasi.svg') }}';">
                        
                        <!-- Mini Gold Floating Trophy Badge -->
                        <div class="absolute -bottom-2 -right-2 w-9 h-9 rounded-2xl bg-gradient-to-tr from-amber-500 to-amber-400 text-white flex items-center justify-center text-sm shadow-md border-2 border-white">
                            <i class="fas fa-trophy"></i>
                        </div>
                    </div>
                    
                    <!-- Student Name & Class -->
                    <h3 class="text-xl sm:text-2xl font-black text-gray-900 mb-1 group-hover:text-emerald-700 transition-colors">
                        {{ $prestasi->nama_siswa }}
                    </h3>
                    <span class="inline-block text-xs font-bold text-emerald-800 bg-emerald-50 px-3 py-1 rounded-full mb-4 border border-emerald-100">
                        Kelas {{ $prestasi->kelas }} &bull; TK NU 04
                    </span>
                    
                    <!-- Award & Contest Details Card -->
                    <div class="w-full bg-gradient-to-br from-amber-50/90 via-amber-100/30 to-amber-50/50 p-4 rounded-2xl border border-amber-200/60 text-center">
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-400 text-slate-950 font-black text-xs uppercase tracking-wider mb-2 shadow-xs">
                            <i class="fas fa-star text-[10px]"></i> {{ $prestasi->juara }}
                        </div>
                        <p class="text-gray-900 font-extrabold text-sm sm:text-base leading-snug">
                            {{ $prestasi->nama_lomba }}
                        </p>
                        @if($prestasi->tingkat)
                            <span class="inline-block text-[11px] font-bold text-amber-800 uppercase tracking-wider bg-amber-200/50 px-2.5 py-0.5 rounded-full mt-2">
                                Tingkat {{ $prestasi->tingkat }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Footer Card Info -->
                <div class="bg-gray-50/80 px-6 py-3.5 border-t border-gray-100 flex justify-between items-center text-xs text-gray-500 font-medium">
                    <span>
                        <i class="far fa-calendar-alt text-emerald-600 mr-1.5"></i> 
                        {{ \Carbon\Carbon::parse($prestasi->tanggal)->translatedFormat('d F Y') }}
                    </span>
                    @if($prestasi->keterangan)
                        <span class="truncate ml-2 text-slate-400 text-[11px]" title="{{ $prestasi->keterangan }}">
                            <i class="fas fa-circle-info text-amber-500 mr-1"></i> {{ \Illuminate\Support\Str::limit($prestasi->keterangan, 22) }}
                        </span>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100" data-aos="fade-in">
                <div class="w-20 h-20 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center text-3xl mx-auto mb-4">
                    <i class="fas fa-award"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Belum Ada Data Prestasi</h3>
                <p class="text-gray-500 text-sm mt-1">Data kejuaraan dan piala santri cilik akan segera diperbarui oleh pihak sekolah.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12 flex justify-center">
        {{ $prestasis->links() }}
    </div>
</div>

@endsection
