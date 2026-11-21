@extends('layouts.admin')
@section('title', 'Dashboard Utama')
@section('header', 'Ringkasan Dashboard')

@section('content')
<div class="space-y-8">

    <!-- 1. Hero Welcome Banner (Modern NU Green & Gold Accent) -->
    <div class="relative bg-gradient-to-r from-[#005A3C] via-[#006F4A] to-[#004B32] rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-emerald-950/20 border border-emerald-600/30 overflow-hidden">
        <!-- Ambient Decorative Circles -->
        <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-0 right-1/4 w-32 h-32 bg-amber-400/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex items-center gap-4 sm:gap-5">
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-white p-2 shadow-lg border border-white/20 flex items-center justify-center flex-shrink-0">
                    <img src="{{ \App\Models\SchoolSetting::getPhoto('logo_path', 'images/logo-nu.png') }}" 
                         alt="Logo NU TK AL-HIDAYAH" 
                         class="w-full h-full object-contain">
                </div>
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-400 text-slate-950 mb-1.5 shadow-sm">
                        <i class="fas fa-star text-[9px]"></i> YAYASAN LP MA'ARIF NU CABANG SITUBONDO
                    </div>
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-black tracking-tight leading-tight">
                        TK NU 04 AL-HIDAYAH
                    </h2>
                    <p class="text-xs sm:text-sm text-emerald-100 font-medium mt-0.5">
                        Sistem Informasi Manajemen, Dokumentasi Kegiatan & Presensi Digital
                    </p>
                </div>
            </div>

            <!-- User Welcome Info Pill -->
            <div class="flex items-center lg:flex-col lg:items-end justify-between pt-4 lg:pt-0 border-t lg:border-t-0 border-white/10">
                <div class="lg:text-right">
                    <p class="text-[11px] text-emerald-200 font-medium">Masuk Sebagai:</p>
                    <p class="text-sm font-extrabold text-white flex items-center gap-1.5">
                        <i class="fas fa-circle-user text-amber-300"></i> {{ auth()->user()->name }}
                    </p>
                </div>
                <span class="inline-flex items-center gap-1.5 mt-1.5 px-3 py-1 rounded-full text-[11px] font-bold text-emerald-950 bg-emerald-200 shadow-sm border border-emerald-300">
                    <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span> Mode Administrator
                </span>
            </div>
        </div>
    </div>

    <!-- Alert Notifikasi Moderasi Komentar Testimoni Baru -->
    @php $pendingTestimoniCount = \App\Models\Testimoni::where('is_approved', false)->count(); @endphp
    @if($pendingTestimoniCount > 0)
        <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-300 rounded-3xl p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-sm animate-fade-in">
            <div class="flex items-center gap-3.5">
                <div class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-xl shadow-md shadow-amber-500/20 flex-shrink-0 animate-bounce">
                    <i class="fas fa-heart"></i>
                </div>
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-200 text-amber-950 mb-1">
                        <i class="fas fa-bell"></i> Perlu Moderasi
                    </div>
                    <h4 class="text-sm font-black text-amber-950">Ada {{ $pendingTestimoniCount }} Komentar Wali Santri Baru!</h4>
                    <p class="text-xs text-amber-800 mt-0.5">Wali santri telah mengirim pesan ulasan pada bagian "Apa Kata Ayah & Bunda". Tinjau dan setujui untuk menayangkannya ke website publik.</p>
                </div>
            </div>
            <a href="{{ route('admin.testimoni.index', ['status' => 'pending']) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 hover:bg-amber-600 active:bg-amber-700 text-slate-950 text-xs font-black rounded-2xl shadow-sm hover:shadow transition-all sm:flex-shrink-0 self-start sm:self-center">
                <span>Tinjau Komentar</span>
                <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
        </div>
    @endif

    <!-- 2. Interactive Stat Cards Grid (Clean Glassmorphism Card Style) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        
        <!-- Stat Card 1: Total Siswa -->
        <div class="bg-white/90 backdrop-blur-md rounded-3xl p-6 shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 group hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Siswa</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-900 mt-2 tracking-tight group-hover:text-emerald-700 transition-colors">
                        {{ $totalSiswa }}
                    </h3>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-600 border border-sky-100 flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform">
                    <i class="fas fa-children"></i>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full font-bold text-[11px] bg-emerald-50 text-emerald-700 border border-emerald-100">
                    <i class="fas fa-arrow-trend-up text-[10px]"></i> {{ $siswaAktif ?? $totalSiswa }} Aktif
                </span>
                <span class="text-[11px] text-slate-400 font-medium">
                    {{ $siswaLaki }} L &bull; {{ $siswaPerempuan }} P
                </span>
            </div>
        </div>

        <!-- Stat Card 2: Total Guru & Staf -->
        <div class="bg-white/90 backdrop-blur-md rounded-3xl p-6 shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 group hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Guru & Tenaga Pendidik</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-900 mt-2 tracking-tight group-hover:text-emerald-700 transition-colors">
                        {{ $totalGuru }}
                    </h3>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform">
                    <i class="fas fa-chalkboard-user"></i>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full font-bold text-[11px] bg-emerald-50 text-emerald-700 border border-emerald-100">
                    <i class="fas fa-check-circle text-[10px]"></i> {{ $hadirHariIni }} Hadir Hari Ini
                </span>
                <a href="{{ route('admin.guru.index') }}" class="text-[11px] text-emerald-600 hover:text-emerald-800 font-bold">
                    Kelola &rarr;
                </a>
            </div>
        </div>

        <!-- Stat Card 3: Galeri Kegiatan (Total Foto) -->
        <div class="bg-white/90 backdrop-blur-md rounded-3xl p-6 shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 group hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Galeri Foto Kegiatan</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-900 mt-2 tracking-tight group-hover:text-cyan-700 transition-colors">
                        {{ $totalGaleri }}
                    </h3>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 border border-cyan-100 flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform">
                    <i class="fas fa-camera-retro"></i>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full font-bold text-[11px] bg-cyan-50 text-cyan-700 border border-cyan-100">
                    <i class="fas fa-images text-[10px]"></i> Dokumentasi Media
                </span>
                <a href="{{ route('admin.galeri.index') }}" class="text-[11px] text-cyan-700 hover:text-cyan-900 font-bold">
                    Koleksi &rarr;
                </a>
            </div>
        </div>

        <!-- Stat Card 4: Acara & Kalender Mendatang -->
        <div class="bg-white/90 backdrop-blur-md rounded-3xl p-6 shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 group hover:-translate-y-1">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Acara / Kalender</p>
                    <h3 class="text-3xl sm:text-4xl font-black text-slate-900 mt-2 tracking-tight group-hover:text-amber-700 transition-colors">
                        {{ $acaraMendatangCount }}
                    </h3>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center text-2xl shadow-inner group-hover:scale-110 transition-transform">
                    <i class="fas fa-calendar-star"></i>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full font-bold text-[11px] bg-amber-50 text-amber-800 border border-amber-100">
                    <i class="far fa-clock text-[10px]"></i> Agenda Mendatang
                </span>
                <a href="{{ route('admin.acara.index') }}" class="text-[11px] text-amber-700 hover:text-amber-900 font-bold">
                    Jadwal &rarr;
                </a>
            </div>
        </div>

    </div>

    <!-- 3. Modern Quick Actions Section (Aksi Cepat Bergaya Ikon Modern) -->
    <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-sm border border-slate-200/80 p-6 sm:p-7">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-base font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                    <i class="fas fa-bolt text-amber-500"></i> Aksi Cepat Administrasi
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Pintasan praktis untuk mengelola operasional sekolah sehari-hari</p>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4">
            
            <!-- Action 1: Tambah Siswa -->
            <a href="{{ route('admin.siswa.index') }}" 
               class="p-4 rounded-2xl bg-sky-50/70 hover:bg-sky-100/90 text-sky-900 border border-sky-200/70 flex flex-col items-center text-center gap-2.5 transition-all group hover:-translate-y-0.5 shadow-xs hover:shadow">
                <div class="w-12 h-12 rounded-xl bg-sky-600 text-white flex items-center justify-center text-lg shadow-sm group-hover:scale-110 transition-transform">
                    <i class="fas fa-user-plus"></i>
                </div>
                <span class="text-xs font-bold leading-snug">Tambah Siswa</span>
            </a>

            <!-- Action 2: Unggah Foto Galeri -->
            <a href="{{ route('admin.galeri.index') }}" 
               class="p-4 rounded-2xl bg-emerald-50/70 hover:bg-emerald-100/90 text-emerald-900 border border-emerald-200/70 flex flex-col items-center text-center gap-2.5 transition-all group hover:-translate-y-0.5 shadow-xs hover:shadow">
                <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-lg shadow-sm group-hover:scale-110 transition-transform">
                    <i class="fas fa-cloud-arrow-up"></i>
                </div>
                <span class="text-xs font-bold leading-snug">Unggah Galeri</span>
            </a>

            <!-- Action 3: Tambah Kalender -->
            <a href="{{ route('admin.kalender.create') }}" 
               class="p-4 rounded-2xl bg-violet-50/70 hover:bg-violet-100/90 text-violet-900 border border-violet-200/70 flex flex-col items-center text-center gap-2.5 transition-all group hover:-translate-y-0.5 shadow-xs hover:shadow">
                <div class="w-12 h-12 rounded-xl bg-violet-600 text-white flex items-center justify-center text-lg shadow-sm group-hover:scale-110 transition-transform">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <span class="text-xs font-bold leading-snug">Tambah Kalender</span>
            </a>

            <!-- Action 4: Presensi Guru -->
            <a href="{{ route('admin.kehadiranguru.index') }}" 
               class="p-4 rounded-2xl bg-amber-50/70 hover:bg-amber-100/90 text-amber-900 border border-amber-200/70 flex flex-col items-center text-center gap-2.5 transition-all group hover:-translate-y-0.5 shadow-xs hover:shadow">
                <div class="w-12 h-12 rounded-xl bg-amber-500 text-white flex items-center justify-center text-lg shadow-sm group-hover:scale-110 transition-transform">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <span class="text-xs font-bold leading-snug">Presensi Guru</span>
            </a>

            <!-- Action 5: Buat Acara Baru -->
            <a href="{{ route('admin.acara.create') }}" 
               class="p-4 rounded-2xl bg-teal-50/70 hover:bg-teal-100/90 text-teal-900 border border-teal-200/70 flex flex-col items-center text-center gap-2.5 transition-all group hover:-translate-y-0.5 shadow-xs hover:shadow">
                <div class="w-12 h-12 rounded-xl bg-teal-600 text-white flex items-center justify-center text-lg shadow-sm group-hover:scale-110 transition-transform">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <span class="text-xs font-bold leading-snug">Buat Agenda</span>
            </a>

            <!-- Action 6: Pengaturan Sekolah -->
            <a href="{{ route('admin.setting.index') }}" 
               class="p-4 rounded-2xl bg-slate-50/70 hover:bg-slate-100/90 text-slate-800 border border-slate-200/70 flex flex-col items-center text-center gap-2.5 transition-all group hover:-translate-y-0.5 shadow-xs hover:shadow">
                <div class="w-12 h-12 rounded-xl bg-slate-700 text-white flex items-center justify-center text-lg shadow-sm group-hover:scale-110 transition-transform">
                    <i class="fas fa-gear"></i>
                </div>
                <span class="text-xs font-bold leading-snug">Pengaturan</span>
            </a>

        </div>
    </div>

    <!-- 3.5. Alamat Sekolah di Website Publik (Manajemen Cepat Alamat) -->
    <div class="bg-gradient-to-br from-white via-white to-emerald-50/30 backdrop-blur-md rounded-3xl shadow-sm border border-slate-200/80 p-6 sm:p-7 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-44 h-44 bg-emerald-500/5 rounded-full blur-2xl pointer-events-none"></div>

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-4 border-b border-slate-100">
            <div class="flex items-start sm:items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 border border-rose-100 flex items-center justify-center text-xl flex-shrink-0 shadow-inner">
                    <i class="fas fa-map-location-dot"></i>
                </div>
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100/70 text-emerald-800 border border-emerald-200/60 mb-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span> Sinkronisasi Website Publik
                    </div>
                    <h3 class="text-base sm:text-lg font-black text-slate-900 tracking-tight">
                        Alamat Lengkap Sekolah di Website Publik
                    </h3>
                    <p class="text-xs text-slate-500">
                        Otomatis tersinkronisasi ke Halaman Profil, Halaman Kontak, dan Bagian Footer Website Utama.
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center gap-2 pt-2 lg:pt-0">
                <button type="button" 
                        onclick="openEditAddressModal()" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white text-xs font-bold rounded-2xl shadow-sm hover:shadow transition-all group">
                    <i class="fas fa-pen-to-square group-hover:rotate-6 transition-transform"></i>
                    <span>Edit Alamat</span>
                </button>

                <a href="{{ url('/kontak') }}" 
                   target="_blank" 
                   class="inline-flex items-center gap-1.5 px-3.5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-2xl transition-all border border-slate-200" 
                   title="Lihat di Website Publik">
                    <i class="fas fa-globe text-emerald-600"></i>
                    <span>Lihat di Web</span>
                    <i class="fas fa-arrow-up-right-from-square text-[10px] opacity-60"></i>
                </a>

                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($alamatSekolah ?? '') }}" 
                   target="_blank" 
                   class="inline-flex items-center gap-1.5 px-3.5 py-2.5 bg-sky-50 hover:bg-sky-100 text-sky-700 text-xs font-semibold rounded-2xl transition-all border border-sky-200" 
                   title="Buka Pencarian Lokasi di Google Maps">
                    <i class="fas fa-map-marked-alt text-sky-600"></i>
                    <span>Google Maps</span>
                    <i class="fas fa-arrow-up-right-from-square text-[10px] opacity-60"></i>
                </a>
            </div>
        </div>

        <!-- Address Text Content Preview -->
        <div class="mt-4 p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-start gap-3">
                <i class="fas fa-location-dot text-rose-500 mt-1 flex-shrink-0 text-base"></i>
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block">Alamat Aktif Saat Ini:</span>
                    <p class="text-sm font-semibold text-slate-800 mt-0.5 leading-relaxed">
                        {{ $alamatSekolah ?? 'Belum ada alamat yang diatur' }}
                    </p>
                </div>
            </div>
            <button type="button" 
                    onclick="openEditAddressModal()" 
                    class="sm:flex-shrink-0 text-xs text-emerald-700 hover:text-emerald-900 font-bold hover:underline self-end sm:self-center">
                Ubah &rarr;
            </button>
        </div>
    </div>

    <!-- 4. Section "Galeri Kegiatan Terbaru" (Grid Cards dengan Hover Zoom & Rounded-2xl) -->
    <div class="bg-white/90 backdrop-blur-md rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-200/80">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6 pb-4 border-b border-slate-100">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-[11px] font-bold mb-1 border border-emerald-200/60">
                    <i class="fas fa-sparkles text-amber-500"></i> Dokumentasi Terkini
                </div>
                <h3 class="text-lg font-black text-slate-900 tracking-tight">Galeri Kegiatan Terbaru</h3>
                <p class="text-xs text-slate-500">Foto momen edukasi, manasik, lomba, dan kreativitas santri di TK NU 04.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.galeri.index') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-2xl shadow-sm hover:shadow transition-all">
                    <i class="fas fa-images"></i> Kelola Galeri Lengkap &rarr;
                </a>
            </div>
        </div>

        <!-- Gallery Grid Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @forelse($galeriTerbaru as $foto)
                @php
                    // Helper sanitasi & resolusi aman asset('storage/' . $foto->foto)
                    $fotoSrc = asset('images/default-galeri.svg');
                    $rawFoto = $foto->foto ? ltrim(trim($foto->foto), '/\\') : null;

                    if ($rawFoto) {
                        if (str_starts_with($rawFoto, 'http://') || str_starts_with($rawFoto, 'https://')) {
                            $fotoSrc = $rawFoto;
                        } elseif (str_starts_with($rawFoto, 'storage/')) {
                            $sub = substr($rawFoto, 8);
                            if (file_exists(public_path('storage/' . $sub)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($sub)) {
                                $fotoSrc = asset('storage/' . $sub);
                            }
                        } elseif (str_starts_with($rawFoto, 'uploads/')) {
                            if (file_exists(public_path($rawFoto))) {
                                $fotoSrc = asset($rawFoto);
                            } elseif (file_exists(public_path('storage/' . $rawFoto))) {
                                $fotoSrc = asset('storage/' . $rawFoto);
                            }
                        } elseif (file_exists(public_path('storage/' . $rawFoto)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($rawFoto)) {
                            $fotoSrc = asset('storage/' . $rawFoto);
                        } elseif (file_exists(public_path($rawFoto))) {
                            $fotoSrc = asset($rawFoto);
                        }
                    }
                @endphp

                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md border border-slate-200/80 transition-all duration-300 flex flex-col group relative">
                    
                    <!-- Thumbnail with Hover Zoom -->
                    <div class="relative w-full h-36 bg-slate-100 overflow-hidden cursor-pointer"
                         onclick="window.location.href='{{ route('admin.galeri.index') }}'">
                        
                        <img src="{{ $fotoSrc }}" 
                             alt="{{ $foto->judul ?? 'Foto Kegiatan' }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 ease-out"
                             loading="lazy"
                             onerror="this.onerror=null;this.src='{{ asset('images/default-galeri.svg') }}';">

                        <!-- Floating Category Pill -->
                        <div class="absolute top-2 left-2">
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-white/95 backdrop-blur-md text-emerald-800 shadow-xs border border-emerald-100">
                                {{ $foto->kategori ?: 'Kegiatan' }}
                            </span>
                        </div>

                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                            <i class="fas fa-eye mr-1"></i> Buka
                        </div>
                    </div>

                    <!-- Caption Content -->
                    <div class="p-3 bg-white flex-1 flex flex-col justify-between">
                        <h4 class="text-xs font-bold text-slate-800 line-clamp-1 group-hover:text-emerald-700 transition-colors" title="{{ $foto->judul }}">
                            {{ $foto->judul ?: 'Dokumentasi' }}
                        </h4>
                        <p class="text-[10px] text-slate-400 mt-1 flex items-center gap-1 font-medium">
                            <i class="far fa-calendar"></i> {{ $foto->created_at ? $foto->created_at->format('d M Y') : 'Baru' }}
                        </p>
                    </div>

                </div>
            @empty
                <div class="col-span-full py-12 px-4 text-center bg-slate-50/60 rounded-2xl border border-dashed border-slate-200">
                    <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl mb-3">
                        <i class="fas fa-camera"></i>
                    </div>
                    <p class="text-xs font-bold text-slate-700">Belum Ada Foto Galeri</p>
                    <p class="text-[11px] text-slate-400 mt-0.5 mb-4">Tambahkan foto kegiatan untuk mempercantik dokumentasi sekolah.</p>
                    <a href="{{ route('admin.galeri.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all shadow-sm">
                        <i class="fas fa-plus"></i> Unggah Foto Pertama
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- 5. Two Columns Section: Upcoming Agendas & Recent Guru Attendance -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left: Agenda & Kalender Mendatang (5 Cols) -->
        <div class="lg:col-span-5 bg-white/90 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-slate-200/80">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                        <i class="fas fa-calendar-check text-emerald-600"></i> Agenda & Acara Mendatang
                    </h3>
                    <p class="text-xs text-slate-500">Jadwal kegiatan penting TK NU 04</p>
                </div>
                <a href="{{ route('admin.acara.index') }}" class="text-xs font-bold text-emerald-700 hover:underline">
                    Lihat Semua &rarr;
                </a>
            </div>

            <div class="space-y-3">
                @forelse($upcomingAcara as $acara)
                    <div class="p-3.5 rounded-2xl bg-slate-50 hover:bg-emerald-50/50 border border-slate-100 transition-colors flex items-start gap-3">
                        <div class="w-11 h-11 rounded-xl bg-emerald-100 text-emerald-800 flex flex-col items-center justify-center flex-shrink-0 font-black text-xs leading-none">
                            <span>{{ \Carbon\Carbon::parse($acara->tanggal)->format('d') }}</span>
                            <span class="text-[9px] font-bold uppercase mt-0.5 text-emerald-600">{{ \Carbon\Carbon::parse($acara->tanggal)->format('M') }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <span class="inline-block px-2 py-0.5 rounded text-[9px] font-extrabold uppercase bg-emerald-100/70 text-emerald-800 mb-1">
                                {{ $acara->kategori ?: 'Kegiatan' }}
                            </span>
                            <h4 class="text-xs font-bold text-slate-800 truncate">{{ $acara->nama }}</h4>
                            <p class="text-[11px] text-slate-500 line-clamp-1 mt-0.5">{{ $acara->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                        </div>
                    </div>
                @empty
                    @forelse($upcomingKalender as $kal)
                        <div class="p-3.5 rounded-2xl bg-slate-50 hover:bg-emerald-50/50 border border-slate-100 transition-colors flex items-start gap-3">
                            <div class="w-11 h-11 rounded-xl bg-violet-100 text-violet-800 flex flex-col items-center justify-center flex-shrink-0 font-black text-xs leading-none">
                                <span>{{ \Carbon\Carbon::parse($kal->tanggal_mulai)->format('d') }}</span>
                                <span class="text-[9px] font-bold uppercase mt-0.5 text-violet-600">{{ \Carbon\Carbon::parse($kal->tanggal_mulai)->format('M') }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="inline-block px-2 py-0.5 rounded text-[9px] font-extrabold uppercase bg-violet-100/70 text-violet-800 mb-1">
                                    {{ $kal->jenis ?: 'Kalender' }}
                                </span>
                                <h4 class="text-xs font-bold text-slate-800 truncate">{{ $kal->nama_kegiatan }}</h4>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-slate-400 text-xs">
                            <i class="far fa-calendar-xmark text-2xl mb-2 text-slate-300"></i>
                            <p>Tidak ada agenda acara mendatang.</p>
                        </div>
                    @endforelse
                @endforelse
            </div>
        </div>

        <!-- Right: Recent Guru Attendance Table (7 Cols) -->
        <div class="lg:col-span-7 bg-white/90 backdrop-blur-md rounded-3xl p-6 shadow-sm border border-slate-200/80 overflow-hidden">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                        <i class="fas fa-clipboard-user text-teal-600"></i> Catatan Presensi Guru Terbaru
                    </h3>
                    <p class="text-xs text-slate-500">Monitoring kehadiran harian dewan guru</p>
                </div>
                <div class="text-right">
                    <a href="{{ route('admin.kehadiranguru.rekap') }}" class="text-xs font-bold text-emerald-700 hover:underline">
                        Rekap &rarr;
                    </a>
                </div>
            </div>

            <!-- Potongan Gaji Banner Mini -->
            <div class="p-3.5 mb-4 rounded-2xl bg-rose-50/70 border border-rose-200/60 flex items-center justify-between text-xs">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-rose-600 text-white flex items-center justify-center text-xs">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div>
                        <p class="font-bold text-rose-900">Total Potongan Bulan Ini</p>
                        <p class="text-[10px] text-rose-600 font-medium">Berdasarkan Alpa / Izin (-Rp5.000 / hari)</p>
                    </div>
                </div>
                <span class="text-sm font-black text-rose-700">
                    Rp {{ number_format($totalPotongan, 0, ',', '.') }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-xs text-left">
                    <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-[10px] rounded-xl">
                        <tr>
                            <th class="px-4 py-2.5 rounded-l-xl">Nama Guru</th>
                            <th class="px-4 py-2.5">Tanggal</th>
                            <th class="px-4 py-2.5 rounded-r-xl">Status Presensi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($kehadiranTerbaru as $hadir)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-4 py-3 font-bold text-slate-800">
                                    {{ $hadir->guru->nama ?? 'Guru' }}
                                </td>
                                <td class="px-4 py-3 text-slate-500">
                                    {{ \Carbon\Carbon::parse($hadir->tanggal)->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    @if($hadir->status == 'Hadir')
                                        <span class="px-2.5 py-1 inline-flex text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800">
                                            <i class="fas fa-check mr-1 mt-0.5"></i> Hadir
                                        </span>
                                    @elseif(in_array($hadir->status, ['Izin', 'Sakit', 'Alpa']))
                                        <span class="px-2.5 py-1 inline-flex text-[10px] font-bold rounded-full bg-rose-100 text-rose-800">
                                            <i class="fas fa-exclamation-circle mr-1 mt-0.5"></i> {{ $hadir->status }}
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 inline-flex text-[10px] font-bold rounded-full bg-amber-100 text-amber-800">
                                            {{ $hadir->status }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-slate-400">
                                    Belum ada catatan presensi guru tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<!-- Modal Edit Alamat Lengkap Website Publik -->
<div id="modal-edit-alamat" 
     class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-slate-950/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300" 
     role="dialog" 
     aria-modal="true" 
     aria-labelledby="modal-title">
    
    <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 w-full max-w-xl overflow-hidden transform scale-95 transition-transform duration-300" id="modal-content-box">
        
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-emerald-800 to-emerald-900 text-white px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-amber-300 text-lg border border-white/20">
                    <i class="fas fa-map-location-dot"></i>
                </div>
                <div>
                    <h4 class="text-base font-black tracking-tight" id="modal-title">Edit Alamat Sekolah</h4>
                    <p class="text-xs text-emerald-200">Perbarui alamat yang tampil di seluruh website publik</p>
                </div>
            </div>
            <button type="button" 
                    onclick="closeEditAddressModal()" 
                    class="w-8 h-8 rounded-xl bg-white/10 hover:bg-white/20 text-emerald-200 hover:text-white flex items-center justify-center transition-colors">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        <!-- Modal Body / Form -->
        <form action="{{ route('admin.dashboard.address') }}" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="input-alamat" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    Alamat Lengkap Sekolah <span class="text-rose-500">*</span>
                </label>
                <textarea id="input-alamat" 
                          name="alamat" 
                          rows="4" 
                          required
                          placeholder="Contoh: 82H9+7FV, Jl. Raya Olean, Olean Tengah, Olean, Kec. Situbondo, Kabupaten Situbondo, Jawa Timur 68316"
                          class="w-full px-4 py-3 rounded-2xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-xs sm:text-sm text-slate-800 placeholder-slate-400 transition-all resize-y shadow-inner">{{ old('alamat', $alamatSekolah ?? '') }}</textarea>
                
                @error('alamat')
                    <p class="text-xs text-rose-600 font-semibold mt-1.5 flex items-center gap-1">
                        <i class="fas fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror

                <div class="mt-3 p-3.5 rounded-2xl bg-amber-50/80 border border-amber-200/80 text-[11px] text-amber-900 leading-relaxed flex items-start gap-2.5">
                    <i class="fas fa-lightbulb text-amber-600 mt-0.5 flex-shrink-0 text-xs"></i>
                    <div>
                        <strong class="font-bold">Tips Penulisan:</strong> Sertakan kode plus lokasi (jika ada), nama jalan, RT/RW, desa/kelurahan, kecamatan, kabupaten, provinsi, dan kode pos agar mudah ditemukan pengunjung dan wali murid di Google Maps.
                    </div>
                </div>
            </div>

            <!-- Modal Actions -->
            <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" 
                        onclick="closeEditAddressModal()" 
                        class="px-4 py-2.5 text-xs font-bold text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition-colors">
                    Batal
                </button>
                <button type="submit" 
                        class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white text-xs font-bold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                    <i class="fas fa-check"></i>
                    <span>Simpan Alamat</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Scripts -->
<script>
    function openEditAddressModal() {
        const modal = document.getElementById('modal-edit-alamat');
        const box = document.getElementById('modal-content-box');
        if (!modal) return;
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            if (box) {
                box.classList.remove('scale-95');
                box.classList.add('scale-100');
            }
            const textarea = document.getElementById('input-alamat');
            if (textarea) textarea.focus();
        }, 10);
    }

    function closeEditAddressModal() {
        const modal = document.getElementById('modal-edit-alamat');
        const box = document.getElementById('modal-content-box');
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

    // Close on backdrop click
    document.getElementById('modal-edit-alamat')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditAddressModal();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEditAddressModal();
        }
    });

    @if($errors->has('alamat'))
        document.addEventListener('DOMContentLoaded', function() {
            openEditAddressModal();
        });
    @endif
</script>
@endsection
