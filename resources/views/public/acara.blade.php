@extends('layouts.public')
@section('title', 'Acara & Agenda - TK NU 04 SITUBONDO')
@section('content')

<!-- Header Banner -->
<div class="bg-gradient-to-b from-[#eaf6ed] via-[#f0fdf4] to-white py-12 lg:py-16 border-b border-emerald-100/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 bg-emerald-100/80 border border-emerald-200/60 px-4 py-1.5 rounded-full text-[#0f3c2b] text-xs font-bold tracking-wide mb-4">
            <i class="fas fa-calendar-star text-emerald-600"></i> Agenda & Acara
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#0f3c2b] tracking-tight mb-4">
            Kegiatan & Acara Sekolah
        </h1>
        <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto font-medium">
            Berbagai kegiatan edukatif, manasik haji santri cilik, perlombaan, dan aktivitas seru di TK NU 04 SITUBONDO.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($acaras as $index => $acara)
            <div class="bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col group" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                <div class="h-60 bg-emerald-50 w-full relative overflow-hidden flex items-center justify-center">
                    <img src="{{ $acara->foto_url }}" 
                         alt="{{ $acara->nama }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
                         loading="lazy"
                         onerror="this.onerror=null;this.src='{{ asset('images/default-acara.svg') }}';">
                    
                    @if($acara->kategori)
                        <div class="absolute top-4 right-4 bg-emerald-700 text-white text-xs font-extrabold px-3 py-1 rounded-full shadow-md">
                            {{ $acara->kategori }}
                        </div>
                    @endif

                    <div class="absolute bottom-4 left-4 bg-white/95 backdrop-blur-md text-emerald-950 text-xs font-black px-3.5 py-1.5 rounded-full shadow border border-gray-100 flex items-center gap-1.5">
                        <i class="far fa-clock text-emerald-600"></i>
                        {{ \Carbon\Carbon::parse($acara->tanggal)->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900 group-hover:text-emerald-700 transition-colors leading-snug">
                            {{ $acara->nama }}
                        </h3>
                        @if($acara->lokasi)
                            <p class="text-xs text-emerald-700 font-semibold mb-3 flex items-center gap-1.5">
                                <i class="fas fa-map-marker-alt text-rose-500"></i> {{ $acara->lokasi }}
                            </p>
                        @endif
                        <p class="text-gray-600 text-sm leading-relaxed font-medium">
                            {{ $acara->deskripsi }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100" data-aos="fade-in">
                <div class="w-20 h-20 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-3xl mx-auto mb-4">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Belum Ada Data Acara</h3>
                <p class="text-gray-500 text-sm mt-1">Data kegiatan mingguan akan segera diperbarui oleh pihak sekolah.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12 flex justify-center">
        {{ $acaras->links() }}
    </div>
</div>

@endsection
