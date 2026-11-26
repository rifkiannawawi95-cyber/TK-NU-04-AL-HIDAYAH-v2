@extends('layouts.public')
@section('title', 'Beranda - TK NU 04 SITUBONDO')
@section('content')

<!-- 1. Hero Section (Modern Minimalist Layout & Clean Whitespace) -->
<section class="relative bg-gradient-to-b from-emerald-50/60 via-slate-50/40 to-white pt-10 pb-16 lg:pt-16 lg:pb-24 overflow-hidden">
    <!-- Ambient Background Blur Accent -->
    <div class="absolute top-0 right-0 -mr-24 -mt-24 w-96 h-96 bg-emerald-200/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-80 h-80 bg-amber-200/25 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            
            <!-- Left Hero Text & CTA -->
            <div class="lg:col-span-7 text-center lg:text-left" data-aos="fade-right">
                <!-- Nu LP Maarif Minimal Badge -->
                <div class="inline-flex items-center gap-2 bg-emerald-100/90 border border-emerald-300/60 px-4 py-1.5 rounded-full text-emerald-900 text-xs font-black tracking-wider uppercase mb-6 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-600 animate-ping"></span>
                    <span>LP MA'ARIF NU CABANG SITUBONDO</span>
                </div>
                
                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-black text-[#0f3c2b] tracking-tight leading-[1.14] mb-6">
                    Tempat Ceria <span class="text-emerald-700">Tumbuh</span>, <br class="hidden sm:inline" />
                    Belajar &amp; <span class="bg-gradient-to-r from-emerald-700 via-teal-600 to-amber-500 bg-clip-text text-transparent">Berakhlakul Karimah</span>
                </h1>

                <p class="text-base sm:text-lg text-slate-600 mb-8 max-w-xl leading-relaxed font-normal mx-auto lg:mx-0">
                    Membina potensi emas anak usia dini dengan kasih sayang, metode bermain sambil belajar yang menyenangkan, serta penanaman akhlak mulia berhaluan Ahlussunnah wal Jama'ah An-Nahdliyah.
                </p>

                <!-- Modern Minimalist Action Buttons -->
                <div class="flex flex-wrap justify-center lg:justify-start items-center gap-3.5">
                    <!-- CTA Button Pendaftaran -->
                    <a href="https://wa.me/6285334766072?text=Halo%20Admin%20TK%20NU%2004%20Situbondo,%20saya%20ingin%20konsultasi%20informasi%20pendaftaran%20siswa%20baru." 
                       target="_blank" 
                       class="inline-flex items-center gap-2.5 bg-gradient-to-r from-emerald-700 via-emerald-800 to-teal-900 hover:from-emerald-800 hover:to-teal-950 text-white font-black px-7 py-4 rounded-full text-sm sm:text-base shadow-lg shadow-emerald-900/20 hover:shadow-xl transition-all transform hover:-translate-y-0.5 group">
                        <i class="fab fa-whatsapp text-lg text-emerald-300 group-hover:scale-110 transition-transform"></i>
                        <span>Info Pendaftaran / PPDB</span>
                        <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <!-- Secondary Explore Button -->
                    <a href="/profil" 
                       class="inline-flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-800 border-2 border-slate-200 hover:border-emerald-400 font-black px-6 py-4 rounded-full text-sm sm:text-base transition-all shadow-xs hover:shadow-sm">
                        <i class="fas fa-school text-emerald-700"></i>
                        <span>Jelajahi Profil &amp; Fasilitas</span>
                    </a>
                </div>

                <!-- Trust Points -->
                <div class="mt-8 pt-6 border-t border-slate-200/70 flex flex-wrap items-center justify-center lg:justify-start gap-4 sm:gap-6 text-xs text-slate-500 font-bold">
                    <span class="flex items-center gap-1.5 bg-white/80 px-3 py-1.5 rounded-full border border-slate-200/60 shadow-2xs"><i class="fas fa-check-circle text-emerald-600"></i> Terdaftar Resmi</span>
                    <span class="flex items-center gap-1.5 bg-white/80 px-3 py-1.5 rounded-full border border-slate-200/60 shadow-2xs"><i class="fas fa-tree text-teal-600"></i> Tanah Sendiri 1.475 m²</span>
                    <span class="flex items-center gap-1.5 bg-white/80 px-3 py-1.5 rounded-full border border-slate-200/60 shadow-2xs"><i class="fas fa-mosque text-amber-500"></i> Pembiasaan Islami</span>
                </div>
            </div>

            <!-- Right Hero Photo Banner -->
            <div class="lg:col-span-5 flex justify-center" data-aos="fade-left" data-aos-delay="100">
                <div class="relative w-full max-w-md">
                    <!-- Decorative Golden & Emerald Ring Accents -->
                    <div class="absolute -top-4 -left-4 w-28 h-28 rounded-3xl bg-amber-400/20 -z-10 rotate-6 blur-xs"></div>
                    <div class="absolute -bottom-4 -right-4 w-32 h-32 rounded-3xl bg-emerald-400/20 -z-10 -rotate-6 blur-xs"></div>

                    <!-- Main Image Frame with Bento Border -->
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-white group">
                        <img src="{{ \App\Models\SchoolSetting::getPhoto('hero_image', 'img/hero_kids.jpg') }}" 
                             alt="Santri Cilik TK NU 04 SITUBONDO" 
                             class="w-full h-80 sm:h-[420px] object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                             onerror="this.onerror=null;this.src='{{ asset('images/default-galeri.svg') }}';">
                        
                        <!-- Floating Pill Badge -->
                        <div class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur-md p-4 rounded-2xl shadow-xl border border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center text-lg shadow-sm">
                                    <i class="fas fa-shapes"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-wider text-slate-400">Pendidikan Berkarakter</p>
                                    <p class="text-xs font-black text-slate-800">Ceria, Cerdas &amp; Mandiri</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[11px] font-black bg-amber-100 text-amber-900 border border-amber-200">
                                TK NU 04
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 2. Minimalist Stat Counters (Clean Bento Counter) -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20" data-aos="fade-up">
    <div class="bg-white rounded-3xl shadow-xl shadow-emerald-950/5 border border-slate-100 p-6 sm:p-8 grid grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Stat 1: Total Siswa -->
        <div class="flex items-center gap-4 group">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center text-2xl flex-shrink-0 group-hover:scale-110 transition-transform shadow-xs">
                <i class="fas fa-children"></i>
            </div>
            <div>
                <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 mb-0.5">Siswa Terdaftar</p>
                <p class="font-display text-2xl sm:text-3xl font-black text-slate-900 leading-tight">
                    {{ $totalSiswa }} <span class="text-xs text-slate-400 font-bold">Anak</span>
                </p>
            </div>
        </div>

        <!-- Stat 2: Pengajar & Guru -->
        <div class="flex items-center gap-4 group">
            <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-700 border border-teal-100 flex items-center justify-center text-2xl flex-shrink-0 group-hover:scale-110 transition-transform shadow-xs">
                <i class="fas fa-chalkboard-user"></i>
            </div>
            <div>
                <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 mb-0.5">Tenaga Pendidik</p>
                <p class="font-display text-2xl sm:text-3xl font-black text-slate-900 leading-tight">
                    {{ $totalGuru }} <span class="text-xs text-slate-400 font-bold">Guru</span>
                </p>
            </div>
        </div>

        <!-- Stat 3: Prestasi -->
        <div class="flex items-center gap-4 group">
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center text-2xl flex-shrink-0 group-hover:scale-110 transition-transform shadow-xs">
                <i class="fas fa-trophy"></i>
            </div>
            <div>
                <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 mb-0.5">Prestasi Diraih</p>
                <p class="font-display text-2xl sm:text-3xl font-black text-slate-900 leading-tight">
                    {{ $totalPrestasi }} <span class="text-xs text-slate-400 font-bold">Piala</span>
                </p>
            </div>
        </div>

        <!-- Stat 4: Kegiatan -->
        <div class="flex items-center gap-4 group">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-100 flex items-center justify-center text-2xl flex-shrink-0 group-hover:scale-110 transition-transform shadow-xs">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div>
                <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400 mb-0.5">Agenda &amp; Acara</p>
                <p class="font-display text-2xl sm:text-3xl font-black text-slate-900 leading-tight">
                    {{ $totalAcara }} <span class="text-xs text-slate-400 font-bold">Kegiatan</span>
                </p>
            </div>
        </div>

    </div>
</section>

<!-- 2b. Section Program Unggulan Karakter & Fasilitas Ramah Anak -->
<section class="py-20 bg-gradient-to-b from-slate-50/80 via-white to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-black uppercase tracking-wider mb-2 border border-emerald-200/60">
                <i class="fas fa-sparkles text-emerald-600"></i> Kurikulum &amp; Ekosistem Pembelajaran
            </div>
            <h2 class="text-3xl sm:text-4xl font-black text-[#0f3c2b] tracking-tight">
                Kenapa Memilih TK NU 04 Situbondo?
            </h2>
            <p class="text-slate-500 text-sm sm:text-base mt-2 font-medium">
                Mengintegrasikan kurikulum nasional PAUD dengan pembinaan karakter islami, adab santri, dan metode bermain aktif yang merangsang kecerdasan majemuk anak.
            </p>
        </div>

        <!-- 4 Core Pillars Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Pillar 1: Tahfidz & Doa -->
            <div class="relative bg-white p-7 rounded-3xl border border-emerald-100 shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1.5 overflow-hidden" data-aos="fade-up" data-aos-delay="0">
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-500 to-teal-400"></div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl mb-5 shadow-xs group-hover:scale-110 transition-transform border border-emerald-100">
                    <i class="fas fa-quran"></i>
                </div>
                <h3 class="font-display text-lg font-black text-slate-800 mb-2 group-hover:text-emerald-700 transition-colors">
                    Tahfidz &amp; Doa Harian
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                    Bimbingan hafalan surat pendek Juz Amma, doa harian, dan sholawat nabi dengan metode murottal yang ceria dan mudah diingat.
                </p>
            </div>

            <!-- Pillar 2: Sholat & Karakter Aswaja -->
            <div class="relative bg-white p-7 rounded-3xl border border-teal-100 shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1.5 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-teal-500 to-emerald-400"></div>
                <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center text-2xl mb-5 shadow-xs group-hover:scale-110 transition-transform border border-teal-100">
                    <i class="fas fa-mosque"></i>
                </div>
                <h3 class="font-display text-lg font-black text-slate-800 mb-2 group-hover:text-teal-700 transition-colors">
                    Praktik Ibadah &amp; Adab
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                    Pembiasaan wudhu, sholat dhuha berjamaah, adab santri, serta penanaman akhlak mulia Ahlussunnah wal Jama'ah sejak dini.
                </p>
            </div>

            <!-- Pillar 3: Kreativitas & Motorik Emas -->
            <div class="relative bg-white p-7 rounded-3xl border border-amber-100 shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1.5 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-amber-400 to-orange-400"></div>
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl mb-5 shadow-xs group-hover:scale-110 transition-transform border border-amber-100">
                    <i class="fas fa-palette"></i>
                </div>
                <h3 class="font-display text-lg font-black text-slate-800 mb-2 group-hover:text-amber-700 transition-colors">
                    Kreativitas &amp; Seni
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                    Melukis, kerajinan tangan, musik edukatif, dan eksplorasi motorik halus yang melatih fokus serta imajinasi kreatif ananda.
                </p>
            </div>

            <!-- Pillar 4: Lingkungan Aman 1.475 m² -->
            <div class="relative bg-white p-7 rounded-3xl border border-emerald-100 shadow-sm hover:shadow-xl transition-all duration-300 group hover:-translate-y-1.5 overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-600 to-teal-500"></div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-800 flex items-center justify-center text-2xl mb-5 shadow-xs group-hover:scale-110 transition-transform border border-emerald-100">
                    <i class="fas fa-shapes"></i>
                </div>
                <h3 class="font-display text-lg font-black text-slate-800 mb-2 group-hover:text-emerald-700 transition-colors">
                    Fasilitas Bermain Luas
                </h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed font-normal">
                    Area tanah sendiri 1.475 m² dengan taman bermain outdoor, perosotan, ayunan, mangkok putar, serta 4 ruang kelas yang bersih &amp; nyaman.
                </p>
            </div>
        </div>

        <!-- Banner Fasilitas Highlight Strip -->
        <div class="bg-gradient-to-r from-emerald-950 via-[#064e3b] to-teal-950 rounded-3xl p-8 sm:p-12 text-white shadow-2xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8 border border-emerald-700/30" data-aos="fade-up">
            <div class="absolute -right-10 -bottom-10 w-72 h-72 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="max-w-xl text-center md:text-left relative z-10">
                <span class="inline-block px-3.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-400 text-slate-950 mb-3 shadow-xs">
                    Ekosistem Belajar Nyaman
                </span>
                <h3 class="font-display text-2xl sm:text-3xl font-black tracking-tight leading-snug">
                    Tumbuh Bersama Teman Ceria &amp; Guru yang Penuh Kasih
                </h3>
                <p class="text-emerald-100/80 text-sm mt-2 font-normal leading-relaxed">
                    Didukung 4 rombongan belajar (Kelompok A &amp; B), sarana sanitasi bersih, dan pengawasan ramah anak terpadu.
                </p>
            </div>

            <div class="flex flex-wrap gap-3.5 justify-center relative z-10 flex-shrink-0">
                <a href="/profil" class="inline-flex items-center gap-2 bg-white text-emerald-950 font-black px-6 py-3.5 rounded-full text-xs sm:text-sm shadow-md hover:bg-slate-100 transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-info-circle text-emerald-700"></i>
                    <span>Profil &amp; Sejarah Sekolah</span>
                </a>
                <a href="/galeri" class="inline-flex items-center gap-2 bg-emerald-800/80 hover:bg-emerald-800 text-white font-bold px-6 py-3.5 rounded-full text-xs sm:text-sm border border-white/20 transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-images text-amber-300"></i>
                    <span>Dokumentasi Kegiatan</span>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- 3. Section Prestasi Siswa (Minimalist Cards dengan Foto Anak + Nama + Juara) -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-12 gap-4" data-aos="fade-up">
            <div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-50 text-amber-800 text-xs font-black uppercase tracking-wider mb-2 border border-amber-200/60">
                    <i class="fas fa-award text-amber-500"></i> Generasi Berbakat
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-[#0f3c2b] tracking-tight">
                    Prestasi Santri Cilik
                </h2>
                <p class="text-slate-500 text-sm mt-1 max-w-lg">
                    Rangkaian piala dan penghargaan yang berhasil diraih oleh siswa-siswi TK NU 04.
                </p>
            </div>
            <a href="/prestasi" class="inline-flex items-center gap-2 text-xs sm:text-sm font-extrabold text-[#00875A] hover:text-[#005A3C] transition-colors">
                <span>Lihat Seluruh Prestasi</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($prestasis as $index => $prestasi)
                <div class="bg-slate-50/80 hover:bg-white rounded-3xl p-6 border border-slate-100 hover:border-amber-200/80 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between group" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    
                    <div>
                        <!-- Header with Photo + Student Name -->
                        <div class="flex items-center gap-4 mb-4">
                            <div class="relative w-16 h-16 rounded-2xl overflow-hidden bg-amber-50 border-2 border-white shadow-sm flex-shrink-0">
                                <img src="{{ $prestasi->foto_url }}" 
                                     alt="{{ $prestasi->nama_siswa }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                     onerror="this.onerror=null;this.src='{{ asset('images/default-prestasi.svg') }}';">
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-base font-black text-slate-800 truncate group-hover:text-emerald-700 transition-colors">
                                    {{ $prestasi->nama_siswa }}
                                </h3>
                                <span class="inline-block text-[10px] font-extrabold text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100 mt-0.5">
                                    Kelas {{ $prestasi->kelas }}
                                </span>
                            </div>
                        </div>

                        <!-- Award Tag & Contest Name -->
                        <div class="bg-white p-4 rounded-2xl border border-slate-100 group-hover:border-amber-200 transition-colors">
                            <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-amber-400 text-slate-950 font-black text-[11px] mb-1.5 shadow-xs">
                                <i class="fas fa-trophy text-[10px]"></i> {{ $prestasi->juara }}
                            </div>
                            <p class="text-xs font-bold text-slate-800 line-clamp-2 leading-snug">
                                {{ $prestasi->nama_lomba }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer Info -->
                    <div class="mt-4 pt-3 border-t border-slate-100/80 flex items-center justify-between text-[11px] text-slate-400 font-semibold">
                        <span><i class="far fa-calendar-alt text-emerald-600 mr-1"></i> {{ \Carbon\Carbon::parse($prestasi->tanggal)->translatedFormat('d M Y') }}</span>
                        @if($prestasi->tingkat)
                            <span class="text-amber-800 font-bold">Tingkat {{ $prestasi->tingkat }}</span>
                        @endif
                    </div>

                </div>
            @empty
                <div class="col-span-full py-12 text-center text-slate-400">
                    <p class="font-bold text-sm">Belum ada data prestasi yang ditampilkan.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 4. Section Acara & Galeri (Grid 3 Kolom Berestetika Modern & Hover Zoom) -->
<section class="py-20 bg-slate-50/60 border-y border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-12 gap-4" data-aos="fade-up">
            <div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-black uppercase tracking-wider mb-2 border border-emerald-200/60">
                    <i class="fas fa-camera text-emerald-600"></i> Dokumentasi &amp; Kegiatan
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-[#0f3c2b] tracking-tight">
                    Momen Seru di Sekolah
                </h2>
                <p class="text-slate-500 text-sm mt-1 max-w-lg">
                    Dokumentasi aktivitas pembelajaran, pentas kreasi, dan interaksi ceria santri.
                </p>
            </div>
            <a href="/galeri" class="inline-flex items-center gap-2 text-xs sm:text-sm font-extrabold text-[#00875A] hover:text-[#005A3C] transition-colors">
                <span>Buka Galeri Foto Lengkap</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <!-- 3-Column Modern Aesthetic Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @forelse($galeris as $index => $galeri)
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-100 transition-all duration-300 flex flex-col group cursor-pointer"
                     onclick="openLightbox('{{ $galeri->foto_url }}', '{{ addslashes($galeri->judul ?: 'Foto Dokumentasi Kegiatan') }}')"
                     data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    
                    <div class="relative h-56 bg-slate-100 overflow-hidden">
                        <img src="{{ $galeri->foto_url }}" 
                             alt="{{ $galeri->judul ?? 'Foto Dokumentasi' }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
                             loading="lazy"
                             onerror="this.onerror=null;this.src='{{ asset('images/default-galeri.svg') }}';">
                        
                        <!-- Top Category Pill -->
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-white/95 backdrop-blur-md text-emerald-800 shadow-xs border border-emerald-100">
                                {{ $galeri->kategori ?: 'Kegiatan' }}
                            </span>
                        </div>

                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-5">
                            <span class="text-white text-xs font-bold flex items-center gap-1.5 bg-emerald-600/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-md">
                                <i class="fas fa-search-plus text-xs"></i> Klik untuk Perbesar
                            </span>
                        </div>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <h3 class="text-sm font-extrabold text-slate-800 line-clamp-1 group-hover:text-emerald-700 transition-colors">
                            {{ $galeri->judul ?: 'Dokumentasi Sekolah' }}
                        </h3>
                        <p class="text-[11px] text-slate-400 mt-2 flex items-center gap-1.5 font-medium">
                            <i class="far fa-clock text-slate-300"></i> {{ $galeri->created_at ? $galeri->created_at->diffForHumans() : 'Terkini' }}
                        </p>
                    </div>

                </div>
            @empty
                <div class="col-span-full py-12 text-center text-slate-400">
                    <p class="font-bold text-sm">Belum ada foto kegiatan di galeri.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 5. Section Dewan Guru / Tenaga Pendidik -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-12 gap-4" data-aos="fade-up">
            <div>
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-black uppercase tracking-wider mb-2 border border-emerald-200/60">
                    <i class="fas fa-chalkboard-teacher text-emerald-600"></i> Pendidik Berdedikasi
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-[#0f3c2b] tracking-tight">
                    Dewan Guru &amp; Tenaga Pendidik
                </h2>
                <p class="text-slate-500 text-sm mt-1 max-w-lg">
                    Para ustadzah dan pengajar yang sabar, hangat, dan penuh kasih membimbing putra-putri tercinta.
                </p>
            </div>
            <a href="/profil" class="inline-flex items-center gap-2 text-xs sm:text-sm font-extrabold text-[#00875A] hover:text-[#005A3C] transition-colors">
                <span>Lihat Seluruh Profil Pendidik</span>
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($gurus as $index => $guru)
                <div class="bg-white rounded-3xl p-6 border border-slate-100 hover:border-emerald-200 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center group hover:-translate-y-1.5"
                     data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
                    
                    <!-- Avatar with Dual-ring Frame -->
                    <div class="relative w-24 h-24 mb-3.5 rounded-full p-1 bg-gradient-to-tr from-emerald-500 via-teal-400 to-amber-300 shadow-md group-hover:scale-105 transition-transform duration-300 flex-shrink-0">
                        <div class="w-full h-full rounded-full overflow-hidden border-2 border-white bg-slate-50">
                            <img src="{{ $guru->foto_url }}" 
                                 alt="{{ $guru->nama }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                 loading="lazy"
                                 onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.svg') }}';">
                        </div>
                    </div>

                    <h3 class="font-display text-sm sm:text-base font-black text-slate-800 leading-snug group-hover:text-emerald-700 transition-colors line-clamp-1">
                        {{ $guru->nama }}
                    </h3>
                    
                    <span class="inline-block text-[11px] font-bold text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-100 mt-1.5">
                        {{ $guru->jabatan ?: 'Tenaga Pendidik' }}
                    </span>

                </div>
            @empty
                <div class="col-span-full py-12 text-center text-slate-400">
                    <p class="font-bold text-sm">Data dewan guru akan segera ditampilkan.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 6. Section Agenda / Kalender Minimalis (Simple Vertical Timeline/List) -->
<section class="py-20 bg-slate-50/60 border-t border-slate-200/60">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-xl mx-auto mb-12" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-violet-50 text-violet-800 text-xs font-black uppercase tracking-wider mb-2 border border-violet-200/60">
                <i class="fas fa-calendar-days text-violet-600"></i> Kalender Minimalis
            </div>
            <h2 class="text-3xl sm:text-4xl font-black text-[#0f3c2b] tracking-tight">
                Agenda Mendatang Sekolah
            </h2>
            <p class="text-slate-500 text-sm mt-1">
                Jadwal agenda pembelajaran dan kegiatan terdekat di TK NU 04 Situbondo.
            </p>
        </div>

        <!-- Vertical Minimalist Agenda Cards -->
        <div class="space-y-3.5" data-aos="fade-up">
            @forelse($kalenders as $kal)
                @php
                    $isLibur = strtolower($kal->jenis) == 'libur';
                    $isUjian = strtolower($kal->jenis) == 'ujian';
                    $dateBg = $isLibur ? 'bg-rose-600 text-white' : ($isUjian ? 'bg-amber-500 text-white' : 'bg-[#00875A] text-white');
                    $badgeBg = $isLibur ? 'bg-rose-50 text-rose-700 border-rose-200' : ($isUjian ? 'bg-amber-50 text-amber-800 border-amber-200' : 'bg-emerald-50 text-emerald-800 border-emerald-200');
                @endphp

                <div class="bg-slate-50/70 hover:bg-white rounded-3xl p-4 sm:p-5 border border-slate-100 hover:border-slate-200 shadow-xs hover:shadow-md transition-all duration-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">
                    
                    <div class="flex items-start sm:items-center gap-4">
                        <!-- Date Badge -->
                        <div class="w-13 h-13 rounded-2xl {{ $dateBg }} flex flex-col items-center justify-center flex-shrink-0 font-black shadow-xs leading-none">
                            <span class="text-sm font-black">{{ \Carbon\Carbon::parse($kal->tanggal_mulai)->format('d') }}</span>
                            <span class="text-[9px] font-bold uppercase mt-0.5 opacity-90">{{ \Carbon\Carbon::parse($kal->tanggal_mulai)->format('M') }}</span>
                        </div>

                        <!-- Activity Title & Category -->
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <h4 class="text-sm sm:text-base font-extrabold text-slate-800 group-hover:text-emerald-700 transition-colors">
                                    {{ $kal->nama_kegiatan }}
                                </h4>
                                <span class="px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider border {{ $badgeBg }}">
                                    {{ $kal->jenis }}
                                </span>
                            </div>

                            <div class="flex items-center gap-2.5 mt-1 text-xs text-slate-400 font-medium">
                                <span><i class="far fa-clock text-emerald-600 mr-1"></i> {{ \Carbon\Carbon::parse($kal->tanggal_mulai)->translatedFormat('d F Y') }}</span>
                                <span>&bull;</span>
                                <span><i class="fas fa-location-dot text-rose-500 mr-1"></i> TK NU 04 Situbondo</span>
                            </div>
                        </div>
                    </div>

                    <div class="self-end sm:self-center">
                        <span class="text-[11px] font-bold text-emerald-800 bg-emerald-50 px-3 py-1 rounded-xl border border-emerald-100 flex items-center gap-1">
                            <i class="far fa-calendar-check text-emerald-600"></i> Terjadwal
                        </span>
                    </div>

                </div>
            @empty
                <div class="text-center py-10 text-slate-400 text-xs">
                    <p>Belum ada jadwal kalender kegiatan mendatang.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-8">
            <a href="/kalender-akademik" class="inline-flex items-center gap-2 text-xs font-bold text-[#00875A] hover:underline">
                <span>Lihat Seluruh Kalender Akademik</span>
                <i class="fas fa-chevron-right text-[10px]"></i>
            </a>
        </div>

    </div>
</section>

<!-- 7. Section Testimoni Hangat Wali Murid (Apa Kata Ayah & Bunda) -->
<section id="testimoni" class="py-20 bg-gradient-to-b from-white via-emerald-50/25 to-white border-t border-slate-100 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Flash Alert Success -->
        @if(session('testimoni_success'))
            <div class="mb-10 max-w-2xl mx-auto bg-emerald-50 border-2 border-emerald-300 text-emerald-950 px-6 py-4 rounded-3xl shadow-lg shadow-emerald-900/10 flex items-start gap-4 animate-fade-in" data-aos="fade-down">
                <div class="w-10 h-10 rounded-2xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0 text-base shadow-sm">
                    <i class="fas fa-circle-check"></i>
                </div>
                <div>
                    <h4 class="font-black text-sm text-emerald-950">Alhamdulillah!</h4>
                    <p class="text-xs sm:text-sm text-emerald-800 mt-0.5 leading-relaxed font-medium">
                        {{ session('testimoni_success') }}
                    </p>
                </div>
            </div>
        @endif

        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12" data-aos="fade-up">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-50 text-amber-800 text-xs font-black uppercase tracking-wider mb-2 border border-amber-200/60">
                    <i class="fas fa-heart text-amber-500"></i> Suara &amp; Kepercayaan Orang Tua
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-[#0f3c2b] tracking-tight">
                    Apa Kata Ayah &amp; Bunda?
                </h2>
                <p class="text-slate-500 text-sm sm:text-base mt-2">
                    Kisah kebahagiaan dan kebanggaan para wali murid yang mempercayakan pendidikan ananda di TK NU 04 Situbondo.
                </p>
            </div>

            <!-- Tombol Aksi Tulis Komentar -->
            <div class="flex-shrink-0">
                <button type="button" 
                        onclick="openTestimoniModal()" 
                        class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-full bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white font-extrabold text-sm shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all group">
                    <i class="fas fa-pen-nib text-amber-300 group-hover:rotate-12 transition-transform"></i>
                    <span>Tulis Komentar / Kesan Pesan</span>
                </button>
            </div>
        </div>

        <!-- Grid Testimoni -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $gradientAvatars = [
                    'from-emerald-600 to-teal-500',
                    'from-amber-500 to-orange-400',
                    'from-teal-600 to-emerald-500',
                    'from-sky-600 to-indigo-500',
                    'from-rose-500 to-pink-500',
                    'from-purple-600 to-violet-500',
                ];
            @endphp

            @forelse($testimonis as $idx => $testi)
                <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between relative group hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ ($idx % 3) * 100 }}">
                    <div class="absolute -top-3.5 right-8 text-4xl text-emerald-100 font-serif font-black select-none pointer-events-none group-hover:text-emerald-200 transition-colors">&ldquo;</div>
                    <div>
                        <!-- Star Ratings -->
                        <div class="flex items-center gap-1 text-amber-400 text-xs mb-4">
                            @for($s = 1; $s <= 5; $s++)
                                <i class="{{ $s <= $testi->rating ? 'fas' : 'far' }} fa-star"></i>
                            @endfor
                        </div>
                        <p class="text-slate-700 text-sm leading-relaxed font-medium italic">
                            "{{ $testi->pesan }}"
                        </p>
                    </div>
                    <div class="mt-6 pt-5 border-t border-slate-100 flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-full bg-gradient-to-tr {{ $gradientAvatars[$idx % count($gradientAvatars)] }} text-white font-black text-sm flex items-center justify-center shadow-xs flex-shrink-0">
                            {{ $testi->initials }}
                        </div>
                        <div class="overflow-hidden">
                            <h4 class="text-sm font-black text-slate-800 truncate">{{ $testi->nama }}</h4>
                            <p class="text-[11px] text-slate-400 font-medium truncate">{{ $testi->peran }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Fallback jika belum ada data -->
                <div class="col-span-full bg-white rounded-3xl p-10 text-center border border-slate-200">
                    <p class="text-slate-500 text-sm">Belum ada testimoni yang ditayangkan. Jadilah yang pertama memberikan kesan dan pesan!</p>
                </div>
            @endforelse
        </div>

    </div>

    <!-- Modal Form Tulis Komentar / Testimoni -->
    <div id="modal-tulis-testimoni" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-slate-950/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300"
         role="dialog"
         aria-modal="true"
         aria-labelledby="modal-testimoni-title">
        
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-lg overflow-hidden transform scale-95 transition-transform duration-300" id="box-testimoni-modal">
            
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-[#005A3C] via-[#006F4A] to-[#004B32] text-white px-6 py-5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-amber-300 text-lg border border-white/20">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-black tracking-tight" id="modal-testimoni-title">Tulis Kesan &amp; Pesan</h4>
                        <p class="text-xs text-emerald-200">Ceritakan pengalaman ananda belajar di TK NU 04</p>
                    </div>
                </div>
                <button type="button" 
                        onclick="closeTestimoniModal()" 
                        class="w-8 h-8 rounded-xl bg-white/10 hover:bg-white/20 text-emerald-200 hover:text-white flex items-center justify-center transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>

            <!-- Modal Form Body -->
            <form action="{{ route('testimoni.store') }}" method="POST" class="p-6 space-y-4">
                @csrf

                <!-- Rating Bintang Selector Interaktif -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Rating Kepuasan <span class="text-rose-500">*</span>
                    </label>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1.5 text-2xl text-amber-400 cursor-pointer select-none" id="star-container">
                            <i class="fas fa-star star-item" data-value="1" onclick="setRating(1)"></i>
                            <i class="fas fa-star star-item" data-value="2" onclick="setRating(2)"></i>
                            <i class="fas fa-star star-item" data-value="3" onclick="setRating(3)"></i>
                            <i class="fas fa-star star-item" data-value="4" onclick="setRating(4)"></i>
                            <i class="fas fa-star star-item" data-value="5" onclick="setRating(5)"></i>
                        </div>
                        <span id="rating-label" class="text-xs font-bold text-slate-500 ml-2">Sangat Puas (5 Bintang)</span>
                    </div>
                    <input type="hidden" name="rating" id="input-rating" value="{{ old('rating', 5) }}">
                    @error('rating')
                        <p class="text-xs text-rose-600 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Nama -->
                <div>
                    <label for="input-nama-testi" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Nama Ayah / Bunda <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           id="input-nama-testi" 
                           name="nama" 
                           value="{{ old('nama') }}"
                           required 
                           maxlength="100"
                           placeholder="Contoh: Bunda Sarah / Ayah Budi"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-xs sm:text-sm text-slate-800 placeholder-slate-400 transition-all">
                    @error('nama')
                        <p class="text-xs text-rose-600 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input Peran / Hubungan -->
                <div>
                    <label for="input-peran-testi" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Status / Peran <span class="text-rose-500">*</span>
                    </label>
                    <select id="input-peran-testi" 
                            name="peran" 
                            required 
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-xs sm:text-sm text-slate-800 transition-all">
                        <option value="Wali Santri Kelompok A" {{ old('peran') == 'Wali Santri Kelompok A' ? 'selected' : '' }}>Wali Santri Kelompok A</option>
                        <option value="Wali Santri Kelompok B" {{ old('peran', 'Wali Santri Kelompok B') == 'Wali Santri Kelompok B' ? 'selected' : '' }}>Wali Santri Kelompok B</option>
                        <option value="Wali Santri Playgroup" {{ old('peran') == 'Wali Santri Playgroup' ? 'selected' : '' }}>Wali Santri Playgroup</option>
                        <option value="Alumni Wali Santri" {{ old('peran') == 'Alumni Wali Santri' ? 'selected' : '' }}>Alumni Wali Santri</option>
                        <option value="Tokoh / Masyarakat" {{ old('peran') == 'Tokoh / Masyarakat' ? 'selected' : '' }}>Tokoh / Masyarakat Sekitar</option>
                    </select>
                    @error('peran')
                        <p class="text-xs text-rose-600 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Textarea Pesan / Kesan -->
                <div>
                    <label for="input-pesan-testi" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Kesan, Pesan &amp; Pengalaman <span class="text-rose-500">*</span>
                    </label>
                    <textarea id="input-pesan-testi" 
                              name="pesan" 
                              rows="4" 
                              required 
                              minlength="5"
                              maxlength="1000"
                              placeholder="Ceritakan perkembangan positif ananda, bimbingan para guru, kenyamanan lingkungan, atau hal berkesan lainnya selama di TK NU 04..."
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-xs sm:text-sm text-slate-800 placeholder-slate-400 transition-all resize-y">{{ old('pesan') }}</textarea>
                    @error('pesan')
                        <p class="text-xs text-rose-600 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Keamanan Info Box -->
                <div class="p-3 bg-amber-50/80 rounded-2xl border border-amber-200/80 text-[11px] text-amber-900 leading-relaxed flex items-start gap-2">
                    <i class="fas fa-shield-halved text-amber-600 mt-0.5 flex-shrink-0"></i>
                    <span>
                        <strong>Catatan Keamanan:</strong> Komentar Anda akan ditinjau oleh Administrator sekolah terlebih dahulu sebelum ditayangkan di website resmi untuk menjaga kenyamanan bersama.
                    </span>
                </div>

                <!-- Action Buttons -->
                <div class="pt-2 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" 
                            onclick="closeTestimoniModal()" 
                            class="px-4 py-2.5 text-xs font-bold text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white text-xs font-bold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                        <i class="fas fa-paper-plane"></i>
                        <span>Kirim Komentar</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Script Modal & Star Rating Selector -->
    <script>
        function openTestimoniModal() {
            const modal = document.getElementById('modal-tulis-testimoni');
            const box = document.getElementById('box-testimoni-modal');
            if (!modal) return;
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                if (box) {
                    box.classList.remove('scale-95');
                    box.classList.add('scale-100');
                }
            }, 10);
        }

        function closeTestimoniModal() {
            const modal = document.getElementById('modal-tulis-testimoni');
            const box = document.getElementById('box-testimoni-modal');
            if (!modal) return;

            modal.classList.add('opacity-0');
            if (box) {
                box.classList.remove('scale-100');
                box.classList.add('scale-95');
            }
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 250);
        }

        const ratingDescriptions = {
            1: 'Kurang Puas (1 Bintang)',
            2: 'Cukup (2 Bintang)',
            3: 'Baik (3 Bintang)',
            4: 'Sangat Baik (4 Bintang)',
            5: 'Sangat Puas (5 Bintang)'
        };

        function setRating(val) {
            const input = document.getElementById('input-rating');
            const label = document.getElementById('rating-label');
            if (input) input.value = val;
            if (label && ratingDescriptions[val]) label.textContent = ratingDescriptions[val];

            const stars = document.querySelectorAll('#star-container .star-item');
            stars.forEach((star, index) => {
                if (index < val) {
                    star.classList.remove('far');
                    star.classList.add('fas');
                } else {
                    star.classList.remove('fas');
                    star.classList.add('far');
                }
            });
        }

        // Close on backdrop click
        document.getElementById('modal-tulis-testimoni')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeTestimoniModal();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeTestimoniModal();
            }
        });

        @if($errors->has('nama') || $errors->has('pesan') || $errors->has('rating') || $errors->has('peran'))
            document.addEventListener('DOMContentLoaded', function() {
                openTestimoniModal();
            });
        @endif
    </script>
</section>

<!-- 8. PPDB & Konsultasi Call to Action Banner -->
<section class="py-20 bg-gradient-to-b from-white via-emerald-50/40 to-slate-100/60 relative overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10" data-aos="fade-up">
        
        <div class="bg-gradient-to-r from-emerald-950 via-[#064e3b] to-teal-950 rounded-3xl sm:rounded-[2.5rem] p-8 sm:p-14 text-white text-center shadow-2xl relative overflow-hidden border border-emerald-700/40">
            <!-- Ambient Glow -->
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-emerald-400/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-amber-400/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-3xl mx-auto">
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-amber-400 text-slate-950 mb-5 shadow-sm">
                    <i class="fas fa-sparkles text-xs"></i> Penerimaan Peserta Didik Baru (PPDB)
                </span>
                
                <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight mb-5 leading-tight text-white">
                    Mari Bergabung Bersama Keluarga Besar TK NU 04 Situbondo
                </h2>
                
                <p class="text-emerald-100/90 text-sm sm:text-base max-w-2xl mx-auto mb-9 font-normal leading-relaxed">
                    Daftarkan putra-putri tercinta sekarang untuk memulai petualangan belajar yang ceria, penuh kasih sayang, dan berakhlakul karimah sejak usia emas.
                </p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="https://wa.me/6285334766072?text=Halo%20Admin%20TK%20NU%2004,%20saya%20ingin%20mendaftar%20atau%20bertanya%20mengenai%20syarat%20pendaftaran%20siswa%20baru." 
                       target="_blank" 
                       class="inline-flex items-center gap-2.5 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-slate-950 font-black px-8 py-4 rounded-full text-sm sm:text-base shadow-xl transition-all transform hover:-translate-y-0.5">
                        <i class="fab fa-whatsapp text-lg"></i>
                        <span>Konsultasi PPDB via WhatsApp</span>
                    </a>
                    <a href="/kontak" 
                       class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white border border-white/25 font-black px-7 py-4 rounded-full text-sm sm:text-base transition-all transform hover:-translate-y-0.5">
                        <i class="fas fa-location-dot text-amber-300"></i>
                        <span>Lokasi &amp; Denah Sekolah</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
