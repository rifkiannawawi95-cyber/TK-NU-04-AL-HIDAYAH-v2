@extends('layouts.public')
@section('title', 'Galeri Kegiatan - TK NU 04 SITUBONDO')
@section('content')

<!-- Header Banner -->
<div class="bg-gradient-to-b from-[#eaf6ed] via-[#f0fdf4] to-white py-12 lg:py-16 border-b border-emerald-100/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 bg-emerald-100/80 border border-emerald-200/60 px-4 py-1.5 rounded-full text-[#0f3c2b] text-xs font-bold tracking-wide mb-4">
            <i class="fas fa-camera-retro text-emerald-600"></i> Dokumentasi Visual
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#0f3c2b] tracking-tight mb-4">
            Galeri Kegiatan Sekolah
        </h1>
        <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto font-medium">
            Dokumentasi momen-momen indah dan ceria dalam aktivitas pembelajaran di TK NU 04 SITUBONDO.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
        @forelse($galeris as $index => $galeri)
            <div class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer border border-gray-100 aspect-square bg-gray-100 flex flex-col" 
                 onclick="openLightbox('{{ $galeri->foto_url }}', '{{ addslashes($galeri->judul ?? 'Foto Kegiatan') }}')"
                 data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 50 }}">
                <img src="{{ $galeri->foto_url }}" 
                     alt="{{ $galeri->judul ?? 'Foto Kegiatan' }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                     loading="lazy"
                     onerror="this.onerror=null;this.src='{{ asset('images/default-galeri.svg') }}';">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-5">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs text-amber-300 font-bold uppercase tracking-wider">{{ $galeri->kategori ?? 'Kegiatan' }}</span>
                        <span class="w-7 h-7 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white text-xs">
                            <i class="fas fa-search-plus"></i>
                        </span>
                    </div>
                    <h3 class="text-white font-bold text-base leading-snug line-clamp-2">{{ $galeri->judul ?? 'Dokumentasi Kegiatan' }}</h3>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100" data-aos="fade-in">
                <div class="w-20 h-20 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-3xl mx-auto mb-4">
                    <i class="fas fa-images"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Belum Ada Foto Galeri</h3>
                <p class="text-gray-500 text-sm mt-1">Dokumentasi foto kegiatan sekolah akan segera diperbarui.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12 flex justify-center">
        {{ $galeris->links() }}
    </div>
</div>

@endsection
