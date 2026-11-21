@extends('layouts.public')
@section('title', 'Hubungi Kami - TK NU 04 SITUBONDO')
@section('content')

<!-- Header Banner -->
<div class="bg-gradient-to-b from-[#eaf6ed] via-[#f0fdf4] to-white py-12 lg:py-16 border-b border-emerald-100/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 bg-emerald-100/80 border border-emerald-200/60 px-4 py-1.5 rounded-full text-[#0f3c2b] text-xs font-bold tracking-wide mb-4">
            <i class="fas fa-envelope-open-text text-emerald-600"></i> Kontak Sekolah
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#0f3c2b] tracking-tight mb-4">
            Hubungi & Kunjungi Kami
        </h1>
        <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto font-medium">
            Kami siap memberikan informasi seputar pendaftaran siswa baru, kegiatan pembelajaran, dan konsultasi pendidikan anak usia dini.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Info Kontak (5 cols) -->
        <div class="lg:col-span-5" data-aos="fade-right">
            <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100 space-y-6">
                <h2 class="text-2xl font-black text-[#0f3c2b] border-b border-gray-100 pb-4">
                    Informasi Kontak
                </h2>

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl flex-shrink-0 shadow-inner">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-base">Alamat Lengkap</h4>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode(\App\Models\SchoolSetting::get('alamat', 'Situbondo, Jawa Timur, Indonesia')) }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="text-gray-600 hover:text-emerald-700 transition-colors mt-1 block group text-sm leading-relaxed font-medium">
                            <p>{{ \App\Models\SchoolSetting::get('alamat', '82H9+7FV, Jl. Raya Olean, Olean Tengah, Olean, Kec. Situbondo, Kabupaten Situbondo, Jawa Timur 68316') }}</p>
                            <span class="inline-flex items-center text-xs font-bold text-emerald-700 group-hover:underline mt-2">
                                <i class="fas fa-directions mr-1.5"></i> Petunjuk Arah Google Maps <i class="fas fa-external-link-alt text-[10px] ml-1.5"></i>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-4 pt-2">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-xl flex-shrink-0 shadow-inner">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-base">Telepon / WhatsApp</h4>
                        @php
                            $telp = \App\Models\SchoolSetting::get('telepon', '085334766072');
                            $cleanTelp = preg_replace('/[^0-9]/', '', $telp);
                        @endphp
                        <a href="https://wa.me/{{ $cleanTelp }}" target="_blank" class="text-emerald-700 font-extrabold hover:underline block mt-1 text-sm">
                            {{ $telp }}
                        </a>
                        <p class="text-xs text-gray-500 mt-0.5">Layanan Informasi & Pendaftaran</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 pt-2">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl flex-shrink-0 shadow-inner">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-base">Email Resmi</h4>
                        <a href="mailto:{{ \App\Models\SchoolSetting::get('email', 'tknusitubondo04@gmail.com') }}" class="text-gray-600 hover:text-emerald-700 hover:underline mt-1 block text-sm font-medium break-all">
                            {{ \App\Models\SchoolSetting::get('email', 'tknusitubondo04@gmail.com') }}
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-4 pt-2">
                    <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-700 flex items-center justify-center text-xl flex-shrink-0 shadow-inner">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-base">Jam Operasional</h4>
                        <p class="text-xs text-gray-600 mt-1 font-medium">Senin - Kamis: 07.00 - 12.00 WIB</p>
                        <p class="text-xs text-gray-600 font-medium">Jumat: 07.00 - 11.00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Peta Google Maps (7 cols) -->
        <div class="lg:col-span-7" data-aos="fade-left">
            <div class="bg-white rounded-3xl shadow-xl p-4 border border-gray-100 overflow-hidden">
                <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100 mb-3">
                    <h3 class="font-extrabold text-gray-900 text-lg flex items-center gap-2">
                        <i class="fas fa-map-marked-alt text-emerald-600"></i> Peta Lokasi Google Maps
                    </h3>
                    <a href="https://www.google.com/maps/search/?api=1&query=82H9%2B7FV%2C+Jl.+Raya+Olean%2C+Olean+Tengah%2C+Olean%2C+Kec.+Situbondo%2C+Kabupaten+Situbondo%2C+Jawa+Timur+68316" 
                       target="_blank" 
                       class="text-xs font-bold text-emerald-700 hover:text-emerald-900 bg-emerald-50 px-3 py-1.5 rounded-full border border-emerald-100">
                        Buka Aplikasi Maps <i class="fas fa-external-link-alt text-[10px] ml-1"></i>
                    </a>
                </div>
                <div class="w-full h-[450px] rounded-2xl overflow-hidden border border-gray-100">
                    <iframe 
                        src="https://maps.google.com/maps?q=82H9%2B7FV%2C+Jl.+Raya+Olean%2C+Olean+Tengah%2C+Olean%2C+Kec.+Situbondo%2C+Kabupaten+Situbondo%2C+Jawa+Timur+68316&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
