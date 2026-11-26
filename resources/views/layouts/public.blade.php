<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TK NU 04 SITUBONDO | @yield('title', 'Lembaga Pendidikan Anak Usia Dini')</title>
    
    <!-- Meta & SEO -->
    <meta name="description" content="TK NU 04 SITUBONDO - Lembaga Pendidikan Anak Usia Dini berkualitas, membentuk generasi cerdas, berkarakter, beriman, dan berakhlak mulia di Situbondo, Jawa Timur.">
    <meta name="keywords" content="TK NU 04 SITUBONDO, TK Situbondo, Pendidikan Anak Usia Dini, PAUD Situbondo, LP Ma'arif NU">
    <meta property="og:title" content="TK NU 04 SITUBONDO | Pendidikan Anak Usia Dini">
    <meta property="og:description" content="Membangun karakter anak usia dini yang cerdas, kreatif, ceria, dan berakhlak mulia berhaluan Ahlussunnah wal Jama'ah.">
    <meta property="og:image" content="{{ asset('images/logo-nu.png') }}">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <!-- Tailwind CSS & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif; 
            scroll-behavior: smooth; 
            -webkit-font-smoothing: antialiased;
        }
        .font-display {
            font-family: 'Outfit', 'Plus Jakarta Sans', sans-serif;
        }
        .nav-scrolled {
            box-shadow: 0 10px 30px -10px rgba(6, 78, 59, 0.08);
            background: rgba(255, 255, 255, 0.96) !important;
            border-bottom: 1px solid rgba(16, 185, 129, 0.15) !important;
        }
        /* Custom Modern Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #10b981;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #059669;
        }
    </style>
</head>
<body class="bg-slate-50/60 flex flex-col min-h-screen text-slate-800 antialiased selection:bg-emerald-600 selection:text-white">

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-emerald-900 via-teal-900 to-[#0f3c2b] text-emerald-100 text-[11px] sm:text-xs py-2 px-4 border-b border-emerald-800/50">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-2 font-medium">
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 font-bold border border-emerald-400/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span> Info PPDB
                </span>
                <span>Penerimaan Peserta Didik Baru Tahun Ajaran 2025/2026 Telah Dibuka!</span>
            </div>
            <div class="flex items-center gap-4 text-emerald-200 font-semibold">
                <a href="https://wa.me/6285334766072" target="_blank" class="hover:text-white transition-colors flex items-center gap-1.5">
                    <i class="fab fa-whatsapp text-emerald-400"></i> 0853-3476-6072
                </a>
                <span class="hidden md:inline text-emerald-700">&bull;</span>
                <span class="hidden md:inline flex items-center gap-1">
                    <i class="fas fa-map-marker-alt text-amber-400"></i> Olean, Situbondo
                </span>
            </div>
        </div>
    </div>

    <!-- Modern Glass Navbar -->
    <nav id="main-nav" class="bg-white/90 backdrop-blur-xl sticky top-0 z-50 border-b border-slate-100/80 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Branding / Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center group gap-3.5">
                        <div class="relative p-1.5 rounded-2xl bg-gradient-to-tr from-emerald-600/10 via-emerald-100/50 to-transparent border border-emerald-200/60 shadow-xs group-hover:scale-105 transition-transform duration-300">
                            <img src="{{ \App\Models\SchoolSetting::getPhoto('logo_path', 'images/logo-nu.png') }}" alt="Logo TK NU 04 SITUBONDO" class="h-10 sm:h-12 w-auto object-contain">
                        </div>
                        <div class="flex flex-col">
                            <span class="font-display font-black text-lg sm:text-xl md:text-2xl tracking-tight text-[#0f3c2b] leading-tight group-hover:text-emerald-700 transition-colors">
                                TK NU 04 SITUBONDO
                            </span>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="text-[11px] font-extrabold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">
                                    LP Ma'arif NU
                                </span>
                                <span class="text-[11px] text-slate-400 font-semibold hidden sm:inline">
                                    Olean &ndash; Jawa Timur
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Menu -->
                <div class="hidden lg:flex items-center space-x-1 lg:space-x-1.5">
                    <a href="/" class="px-3.5 py-2 font-bold text-xs tracking-wide uppercase transition-all duration-200 rounded-full flex items-center gap-1.5 {{ request()->is('/') ? 'bg-emerald-50 text-emerald-800 shadow-xs border border-emerald-200/60' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-50' }}">
                        <i class="fas fa-home text-xs {{ request()->is('/') ? 'text-emerald-600' : 'text-slate-400' }}"></i> Beranda
                    </a>
                    <a href="/profil" class="px-3.5 py-2 font-bold text-xs tracking-wide uppercase transition-all duration-200 rounded-full flex items-center gap-1.5 {{ request()->is('profil') ? 'bg-emerald-50 text-emerald-800 shadow-xs border border-emerald-200/60' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-50' }}">
                        <i class="fas fa-school text-xs {{ request()->is('profil') ? 'text-emerald-600' : 'text-slate-400' }}"></i> Profil
                    </a>
                    <a href="/acara" class="px-3.5 py-2 font-bold text-xs tracking-wide uppercase transition-all duration-200 rounded-full flex items-center gap-1.5 {{ request()->is('acara*') ? 'bg-emerald-50 text-emerald-800 shadow-xs border border-emerald-200/60' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-50' }}">
                        <i class="fas fa-calendar-alt text-xs {{ request()->is('acara*') ? 'text-emerald-600' : 'text-slate-400' }}"></i> Acara
                    </a>
                    <a href="/prestasi" class="px-3.5 py-2 font-bold text-xs tracking-wide uppercase transition-all duration-200 rounded-full flex items-center gap-1.5 {{ request()->is('prestasi*') ? 'bg-emerald-50 text-emerald-800 shadow-xs border border-emerald-200/60' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-50' }}">
                        <i class="fas fa-award text-xs {{ request()->is('prestasi*') ? 'text-emerald-600' : 'text-slate-400' }}"></i> Prestasi
                    </a>
                    <a href="/galeri" class="px-3.5 py-2 font-bold text-xs tracking-wide uppercase transition-all duration-200 rounded-full flex items-center gap-1.5 {{ request()->is('galeri*') ? 'bg-emerald-50 text-emerald-800 shadow-xs border border-emerald-200/60' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-50' }}">
                        <i class="fas fa-images text-xs {{ request()->is('galeri*') ? 'text-emerald-600' : 'text-slate-400' }}"></i> Galeri
                    </a>
                    <a href="/kalender-akademik" class="px-3.5 py-2 font-bold text-xs tracking-wide uppercase transition-all duration-200 rounded-full flex items-center gap-1.5 {{ request()->is('kalender-akademik*') ? 'bg-emerald-50 text-emerald-800 shadow-xs border border-emerald-200/60' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-50' }}">
                        <i class="fas fa-calendar-check text-xs {{ request()->is('kalender-akademik*') ? 'text-emerald-600' : 'text-slate-400' }}"></i> Kalender
                    </a>
                    <a href="/kontak" class="px-3.5 py-2 font-bold text-xs tracking-wide uppercase transition-all duration-200 rounded-full flex items-center gap-1.5 {{ request()->is('kontak') ? 'bg-emerald-50 text-emerald-800 shadow-xs border border-emerald-200/60' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-50' }}">
                        <i class="fas fa-envelope text-xs {{ request()->is('kontak') ? 'text-emerald-600' : 'text-slate-400' }}"></i> Kontak
                    </a>
                    
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="/admin/dashboard" class="ml-3 bg-gradient-to-r from-emerald-700 to-teal-800 hover:from-emerald-800 hover:to-teal-900 text-white px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-wider shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                                <i class="fas fa-th-large text-xs"></i> Dashboard Admin
                            </a>
                        @else
                            <a href="/user/dashboard" class="ml-3 bg-gradient-to-r from-emerald-700 to-teal-800 hover:from-emerald-800 hover:to-teal-900 text-white px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-wider shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                                <i class="fas fa-chalkboard-user text-xs"></i> Portal Guru
                            </a>
                        @endif
                    @else
                        <a href="/login" class="ml-3 bg-gradient-to-r from-emerald-700 to-[#0f3c2b] hover:from-emerald-800 hover:to-emerald-950 text-white px-6 py-2.5 rounded-full text-xs font-black uppercase tracking-wider shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center gap-2 border border-emerald-600/30">
                            <i class="fas fa-lock text-xs"></i> Portal Masuk
                        </a>
                    @endauth
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="lg:hidden flex items-center">
                    <button id="mobile-menu-btn" aria-label="Menu Navigasi" class="text-slate-700 hover:text-emerald-700 p-2.5 rounded-2xl bg-slate-100/80 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-colors">
                        <i class="fas fa-bars text-xl" id="menu-icon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white/95 backdrop-blur-xl shadow-2xl w-full border-t border-slate-100 transition-all duration-300">
            <div class="px-5 py-5 space-y-2">
                <a href="/" class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm {{ request()->is('/') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fas fa-home text-emerald-600 w-5"></i> Beranda
                </a>
                <a href="/profil" class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm {{ request()->is('profil') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fas fa-school text-emerald-600 w-5"></i> Profil Sekolah
                </a>
                <a href="/acara" class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm {{ request()->is('acara*') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fas fa-calendar-alt text-emerald-600 w-5"></i> Acara &amp; Agenda
                </a>
                <a href="/prestasi" class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm {{ request()->is('prestasi*') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fas fa-award text-emerald-600 w-5"></i> Prestasi Santri
                </a>
                <a href="/galeri" class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm {{ request()->is('galeri*') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fas fa-images text-emerald-600 w-5"></i> Galeri Dokumentasi
                </a>
                <a href="/kalender-akademik" class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm {{ request()->is('kalender-akademik*') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fas fa-calendar-check text-emerald-600 w-5"></i> Kalender Akademik
                </a>
                <a href="/kontak" class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold text-sm {{ request()->is('kontak') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'text-slate-700 hover:bg-slate-50' }}">
                    <i class="fas fa-envelope text-emerald-600 w-5"></i> Kontak &amp; Lokasi
                </a>
                
                <div class="pt-3 border-t border-slate-100">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="/admin/dashboard" class="block px-4 py-3 bg-emerald-700 text-white font-extrabold text-center rounded-2xl shadow-md">Dashboard Admin</a>
                        @else
                            <a href="/user/dashboard" class="block px-4 py-3 bg-emerald-700 text-white font-extrabold text-center rounded-2xl shadow-md">Portal Guru</a>
                        @endif
                    @else
                        <a href="/login" class="block px-4 py-3 bg-gradient-to-r from-emerald-700 to-[#0f3c2b] text-white font-extrabold text-center rounded-2xl shadow-md">Login Portal</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Premium Footer -->
    <footer class="bg-slate-950 text-slate-300 pt-16 pb-10 mt-auto relative overflow-hidden border-t border-emerald-900/40">
        <!-- Ambient Background Glows -->
        <div class="absolute top-0 right-0 -mr-24 -mt-24 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-24 -mb-24 w-96 h-96 rounded-full bg-teal-500/10 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 lg:gap-12 pb-12 border-b border-slate-800/80">
                
                <!-- School Profile & Identity -->
                <div class="md:col-span-5">
                    <div class="flex items-center gap-3.5 mb-6">
                        <div class="p-2 rounded-2xl bg-white/10 border border-white/10 flex-shrink-0">
                            <img src="{{ \App\Models\SchoolSetting::getPhoto('logo_path', 'images/logo-nu.png') }}" alt="Logo Nahdlatul Ulama" class="h-12 w-auto object-contain">
                        </div>
                        <div>
                            <h3 class="font-display text-xl sm:text-2xl font-black text-white tracking-tight leading-tight">TK NU 04 SITUBONDO</h3>
                            <p class="text-[11px] text-emerald-400 font-extrabold tracking-wider uppercase mt-0.5">LP Ma'arif NU Cabang Situbondo</p>
                        </div>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6 pr-4 font-normal">
                        Membangun karakter anak usia dini yang cerdas, mandiri, kreatif, dan berakhlakul karimah dengan pondasi nilai-nilai Ahlussunnah wal Jama'ah An-Nahdliyah.
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="https://wa.me/6285334766072" target="_blank" class="w-10 h-10 rounded-2xl bg-slate-900 border border-slate-800 hover:border-emerald-500/50 flex items-center justify-center text-slate-400 hover:bg-emerald-600 hover:text-white transition-all transform hover:-translate-y-1 shadow-sm" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="mailto:tknusitubondo04@gmail.com" class="w-10 h-10 rounded-2xl bg-slate-900 border border-slate-800 hover:border-emerald-500/50 flex items-center justify-center text-slate-400 hover:bg-emerald-600 hover:text-white transition-all transform hover:-translate-y-1 shadow-sm" aria-label="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-2xl bg-slate-900 border border-slate-800 hover:border-emerald-500/50 flex items-center justify-center text-slate-400 hover:bg-emerald-600 hover:text-white transition-all transform hover:-translate-y-1 shadow-sm" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-2xl bg-slate-900 border border-slate-800 hover:border-emerald-500/50 flex items-center justify-center text-slate-400 hover:bg-emerald-600 hover:text-white transition-all transform hover:-translate-y-1 shadow-sm" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Navigation Links -->
                <div class="md:col-span-3 md:col-start-7">
                    <h4 class="font-display text-sm font-black text-white uppercase tracking-wider mb-6 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Navigasi Utama
                    </h4>
                    <ul class="text-slate-400 space-y-3 text-sm">
                        <li><a href="/profil" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-emerald-500"></i> Profil &amp; Sejarah Lembaga</a></li>
                        <li><a href="/prestasi" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-emerald-500"></i> Prestasi Santri Cilik</a></li>
                        <li><a href="/galeri" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-emerald-500"></i> Galeri Kegiatan Sekolah</a></li>
                        <li><a href="/acara" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-emerald-500"></i> Agenda &amp; Acara Terbaru</a></li>
                        <li><a href="/kalender-akademik" class="hover:text-emerald-400 transition-colors flex items-center gap-2"><i class="fas fa-chevron-right text-[10px] text-emerald-500"></i> Kalender Akademik</a></li>
                    </ul>
                </div>

                <!-- Contact & Location Info -->
                <div class="md:col-span-3">
                    <h4 class="font-display text-sm font-black text-white uppercase tracking-wider mb-6 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span> Kontak Sekolah
                    </h4>
                    @php
                        $footerAlamat = \App\Models\SchoolSetting::get('alamat', 'Jl. Raya Olean RT 005 RW 003, Desa Olean, Kec. Situbondo, Kab. Situbondo, Jawa Timur 68316');
                        $footerTelp = \App\Models\SchoolSetting::get('telepon', '085334766072');
                        $footerEmail = \App\Models\SchoolSetting::get('email', 'tknusitubondo04@gmail.com');
                        $footerWa = preg_replace('/[^0-9]/', '', $footerTelp);
                        if (str_starts_with($footerWa, '0')) {
                            $footerWa = '62' . substr($footerWa, 1);
                        }
                    @endphp
                    <ul class="text-slate-400 space-y-4 text-xs sm:text-sm">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-location-dot mt-1 text-emerald-400 flex-shrink-0 text-sm"></i>
                            <span class="leading-relaxed">{{ $footerAlamat }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fab fa-whatsapp text-emerald-400 flex-shrink-0 text-base"></i>
                            <a href="https://wa.me/{{ $footerWa }}" target="_blank" class="hover:text-emerald-300 font-semibold transition-colors">{{ $footerTelp }}</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-emerald-400 flex-shrink-0 text-sm"></i>
                            <a href="mailto:{{ $footerEmail }}" class="hover:text-emerald-300 transition-colors break-all">{{ $footerEmail }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-slate-500 gap-4">
                <div class="text-center md:text-left">
                    &copy; {{ date('Y') }} <strong class="text-slate-300">TK NU 04 SITUBONDO</strong> &bull; LP Ma'arif NU Situbondo. All rights reserved.
                </div>
                <div class="text-center md:text-right flex items-center gap-1 text-slate-400">
                    <span>Mendidik dengan hati untuk masa depan generasi islami.</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp CTA Widget -->
    @php
        $waRaw = \App\Models\SchoolSetting::get('telepon', '085334766072');
        $waNum = preg_replace('/[^0-9]/', '', $waRaw);
        if (str_starts_with($waNum, '0')) {
            $waNum = '62' . substr($waNum, 1);
        }
    @endphp
    <div class="fixed bottom-6 right-6 z-50 flex items-end gap-3 group">
        <!-- Floating Tooltip / Chat Bubble -->
        <div id="wa-bubble" class="hidden sm:flex items-center gap-3 bg-white/95 backdrop-blur-md px-4 py-2.5 rounded-2xl shadow-xl border border-emerald-100 text-slate-800 text-xs font-semibold animate-bounce shadow-emerald-900/10 transition-all">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
            <span>Tanya Info PPDB &amp; Sekolah? <strong>Chat Kami!</strong></span>
            <button type="button" onclick="document.getElementById('wa-bubble').remove()" class="text-slate-400 hover:text-slate-600 ml-1">
                <i class="fas fa-times text-[10px]"></i>
            </button>
        </div>

        <a href="https://wa.me/{{ $waNum }}?text=Halo%20Admin%20TK%20NU%2004%20Situbondo,%20saya%20ingin%20konsultasi%20informasi%20sekolah%20dan%20pendaftaran%20siswa%20baru." 
           target="_blank" 
           rel="noopener noreferrer"
           aria-label="Hubungi Kami di WhatsApp"
           class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-gradient-to-tr from-emerald-600 to-green-500 hover:from-emerald-500 hover:to-green-400 text-white flex items-center justify-center text-2xl sm:text-3xl shadow-2xl shadow-emerald-600/40 hover:shadow-emerald-600/60 transition-all duration-300 transform hover:scale-110 active:scale-95 flex-shrink-0 relative">
            <i class="fab fa-whatsapp"></i>
            <span class="absolute -top-1 -right-1 w-4 h-4 bg-amber-400 rounded-full border-2 border-white flex items-center justify-center">
                <span class="w-1.5 h-1.5 bg-emerald-950 rounded-full"></span>
            </span>
        </a>
    </div>

    <!-- Global Image Lightbox Modal -->
    <div id="global-lightbox" class="fixed inset-0 bg-slate-950/85 backdrop-blur-md z-50 hidden flex items-center justify-center p-4 transition-opacity duration-300" onclick="closeLightbox(event)">
        <div class="relative max-w-4xl w-full max-h-[90vh] flex flex-col items-center" onclick="event.stopPropagation()">
            <button type="button" onclick="closeLightbox()" class="absolute -top-12 right-0 sm:-right-4 text-white/80 hover:text-white text-2xl font-black w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all">
                <i class="fas fa-times"></i>
            </button>
            <img id="lightbox-img" src="" alt="Preview" class="max-w-full max-h-[80vh] object-contain rounded-2xl shadow-2xl border border-white/20">
            <p id="lightbox-caption" class="text-white text-center mt-3 text-sm font-semibold max-w-xl truncate"></p>
        </div>
    </div>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 80,
            duration: 700,
            easing: 'ease-out-cubic',
        });

        // Lightbox Functions
        function openLightbox(src, caption) {
            var img = document.getElementById('lightbox-img');
            var cap = document.getElementById('lightbox-caption');
            var modal = document.getElementById('global-lightbox');
            if (img && modal) {
                img.src = src;
                if (cap) cap.textContent = caption || '';
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }
        }
        function closeLightbox(e) {
            var modal = document.getElementById('global-lightbox');
            var img = document.getElementById('lightbox-img');
            if (modal) {
                modal.classList.add('hidden');
                if (img) img.src = '';
                document.body.classList.remove('overflow-hidden');
            }
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLightbox();
        });

        // Sticky nav scroll shadow
        window.addEventListener('scroll', function() {
            var nav = document.getElementById('main-nav');
            if (window.scrollY > 20) {
                nav.classList.add('nav-scrolled');
            } else {
                nav.classList.remove('nav-scrolled');
            }
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            var icon = document.getElementById('menu-icon');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                menu.classList.add('hidden');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    </script>
</body>
</html>

