<!DOCTYPE html>
<html lang="id">
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Outfit', sans-serif; scroll-behavior: smooth; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.7);
        }
        .nav-scrolled {
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.95);
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen text-gray-800 antialiased selection:bg-green-600 selection:text-white">

    <!-- Navbar -->
    <nav id="main-nav" class="bg-white/95 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Branding / Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center group">
                        <img src="{{ \App\Models\SchoolSetting::getPhoto('logo_path', 'images/logo-nu.png') }}" alt="Logo TK NU 04 SITUBONDO" class="h-11 sm:h-12 w-auto mr-3 drop-shadow transition-transform duration-300 group-hover:scale-105 object-contain">
                        <div class="flex flex-col">
                            <span class="font-black text-lg sm:text-xl md:text-2xl tracking-tight text-[#0f3c2b] leading-tight group-hover:text-emerald-700 transition-colors">
                                TK NU 04 SITUBONDO
                            </span>
                            <span class="text-xs text-gray-500 font-semibold tracking-wide">
                                Situbondo &ndash; Jawa Timur
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Menu -->
                <div class="hidden lg:flex items-center space-x-1 lg:space-x-4">
                    <a href="/" class="px-3 py-2 font-semibold text-sm transition-all duration-200 flex items-center gap-1.5 {{ request()->is('/') ? 'text-emerald-700 font-bold border-b-2 border-emerald-600' : 'text-gray-600 hover:text-emerald-600' }}">
                        <i class="fas fa-home text-xs {{ request()->is('/') ? 'text-emerald-600' : 'text-gray-400' }}"></i> Beranda
                    </a>
                    <a href="/profil" class="px-3 py-2 font-semibold text-sm transition-all duration-200 flex items-center gap-1.5 {{ request()->is('profil') ? 'text-emerald-700 font-bold border-b-2 border-emerald-600' : 'text-gray-600 hover:text-emerald-600' }}">
                        <i class="fas fa-user-circle text-xs {{ request()->is('profil') ? 'text-emerald-600' : 'text-gray-400' }}"></i> Profil
                    </a>
                    <a href="/acara" class="px-3 py-2 font-semibold text-sm transition-all duration-200 flex items-center gap-1.5 {{ request()->is('acara*') ? 'text-emerald-700 font-bold border-b-2 border-emerald-600' : 'text-gray-600 hover:text-emerald-600' }}">
                        <i class="fas fa-calendar-alt text-xs {{ request()->is('acara*') ? 'text-emerald-600' : 'text-gray-400' }}"></i> Acara
                    </a>
                    <a href="/prestasi" class="px-3 py-2 font-semibold text-sm transition-all duration-200 flex items-center gap-1.5 {{ request()->is('prestasi*') ? 'text-emerald-700 font-bold border-b-2 border-emerald-600' : 'text-gray-600 hover:text-emerald-600' }}">
                        <i class="fas fa-trophy text-xs {{ request()->is('prestasi*') ? 'text-emerald-600' : 'text-gray-400' }}"></i> Prestasi
                    </a>
                    <a href="/galeri" class="px-3 py-2 font-semibold text-sm transition-all duration-200 flex items-center gap-1.5 {{ request()->is('galeri*') ? 'text-emerald-700 font-bold border-b-2 border-emerald-600' : 'text-gray-600 hover:text-emerald-600' }}">
                        <i class="fas fa-images text-xs {{ request()->is('galeri*') ? 'text-emerald-600' : 'text-gray-400' }}"></i> Galeri
                    </a>
                    <a href="/kalender-akademik" class="px-3 py-2 font-semibold text-sm transition-all duration-200 flex items-center gap-1.5 {{ request()->is('kalender-akademik*') ? 'text-emerald-700 font-bold border-b-2 border-emerald-600' : 'text-gray-600 hover:text-emerald-600' }}">
                        <i class="fas fa-calendar-check text-xs {{ request()->is('kalender-akademik*') ? 'text-emerald-600' : 'text-gray-400' }}"></i> Kalender
                    </a>
                    <a href="/kontak" class="px-3 py-2 font-semibold text-sm transition-all duration-200 flex items-center gap-1.5 {{ request()->is('kontak') ? 'text-emerald-700 font-bold border-b-2 border-emerald-600' : 'text-gray-600 hover:text-emerald-600' }}">
                        <i class="fas fa-envelope text-xs {{ request()->is('kontak') ? 'text-emerald-600' : 'text-gray-400' }}"></i> Kontak
                    </a>
                    
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="/admin/dashboard" class="ml-2 bg-[#046c4e] hover:bg-[#03543d] text-white px-6 py-2.5 rounded-full text-sm font-bold shadow transition-all transform hover:scale-105 flex items-center gap-2">
                                <i class="fas fa-th-large text-xs"></i> Dashboard Admin
                            </a>
                        @else
                            <a href="/user/dashboard" class="ml-2 bg-[#046c4e] hover:bg-[#03543d] text-white px-6 py-2.5 rounded-full text-sm font-bold shadow transition-all transform hover:scale-105 flex items-center gap-2">
                                <i class="fas fa-th-large text-xs"></i> Dashboard Guru
                            </a>
                        @endif
                    @else
                        <a href="/login" class="ml-2 bg-[#046c4e] hover:bg-[#03543d] text-white px-6 py-2.5 rounded-full text-sm font-bold shadow transition-all transform hover:scale-105 flex items-center gap-2">
                            <i class="fas fa-user-circle text-sm"></i> Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="lg:hidden flex items-center">
                    <button id="mobile-menu-btn" aria-label="Menu Navigasi" class="text-[#0f3c2b] hover:text-emerald-600 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 transition-colors">
                        <i class="fas fa-bars text-2xl" id="menu-icon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white/95 backdrop-blur-lg shadow-xl w-full border-t border-gray-100 transition-all duration-300">
            <div class="px-4 py-4 space-y-1.5">
                <a href="/" class="block px-4 py-2.5 rounded-xl font-semibold text-base {{ request()->is('/') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700' }}">Beranda</a>
                <a href="/profil" class="block px-4 py-2.5 rounded-xl font-semibold text-base {{ request()->is('profil') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700' }}">Profil</a>
                <a href="/acara" class="block px-4 py-2.5 rounded-xl font-semibold text-base {{ request()->is('acara*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700' }}">Acara</a>
                <a href="/prestasi" class="block px-4 py-2.5 rounded-xl font-semibold text-base {{ request()->is('prestasi*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700' }}">Prestasi</a>
                <a href="/galeri" class="block px-4 py-2.5 rounded-xl font-semibold text-base {{ request()->is('galeri*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700' }}">Galeri</a>
                <a href="/kalender-akademik" class="block px-4 py-2.5 rounded-xl font-semibold text-base {{ request()->is('kalender-akademik*') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700' }}">Kalender</a>
                <a href="/kontak" class="block px-4 py-2.5 rounded-xl font-semibold text-base {{ request()->is('kontak') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700' }}">Kontak</a>
                
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="/admin/dashboard" class="block px-4 py-3 mt-3 bg-[#046c4e] text-white font-bold text-center rounded-xl shadow-md">Dashboard Admin</a>
                    @else
                        <a href="/user/dashboard" class="block px-4 py-3 mt-3 bg-[#046c4e] text-white font-bold text-center rounded-xl shadow-md">Dashboard Guru</a>
                    @endif
                @else
                    <a href="/login" class="block px-4 py-3 mt-3 bg-[#046c4e] text-white font-bold text-center rounded-xl shadow-md">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Premium Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8 mt-auto relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-green-500 opacity-10 blur-3xl pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10">
                <div class="md:col-span-5">
                    <div class="flex items-center mb-6">
                        <img src="{{ \App\Models\SchoolSetting::getPhoto('logo_path', 'images/logo-nu.png') }}" alt="Logo Nahdlatul Ulama" class="h-14 w-auto mr-3 object-contain rounded-lg p-1 bg-white/10">
                        <div>
                            <h3 class="text-2xl font-extrabold tracking-tight">TK NU 04 SITUBONDO</h3>
                            <p class="text-xs text-green-400 font-semibold tracking-wider uppercase">Situbondo &ndash; Jawa Timur</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-base leading-relaxed mb-6 pr-4">
                        Membangun generasi cerdas, beriman, dan berakhlak mulia sejak dini dengan pendekatan bermain sambil belajar berhaluan Ahlussunnah wal Jama'ah.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-green-600 hover:text-white transition-all transform hover:-translate-y-1" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-green-600 hover:text-white transition-all transform hover:-translate-y-1" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-green-600 hover:text-white transition-all transform hover:-translate-y-1" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="md:col-span-3 md:col-start-7">
                    <h4 class="text-lg font-bold mb-6 text-white uppercase tracking-wider text-sm border-b border-gray-800 pb-2">Tautan Cepat</h4>
                    <ul class="text-gray-400 space-y-3">
                        <li><a href="/profil" class="hover:text-yellow-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-green-500"></i> Profil Sekolah</a></li>
                        <li><a href="/prestasi" class="hover:text-yellow-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-green-500"></i> Prestasi Siswa</a></li>
                        <li><a href="/galeri" class="hover:text-yellow-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-green-500"></i> Galeri Kegiatan</a></li>
                        <li><a href="/acara" class="hover:text-yellow-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-green-500"></i> Acara Terbaru</a></li>
                        <li><a href="/kalender-akademik" class="hover:text-yellow-400 transition-colors flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-green-500"></i> Kalender Akademik</a></li>
                    </ul>
                </div>

                <div class="md:col-span-3">
                    <h4 class="text-lg font-bold mb-6 text-white uppercase tracking-wider text-sm border-b border-gray-800 pb-2">Hubungi Kami</h4>
                    @php
                        $footerAlamat = \App\Models\SchoolSetting::get('alamat', '82H9+7FV, Jl. Raya Olean, Olean Tengah, Olean, Kec. Situbondo, Kabupaten Situbondo, Jawa Timur 68316');
                        $footerTelp = \App\Models\SchoolSetting::get('telepon', '085334766072');
                        $footerEmail = \App\Models\SchoolSetting::get('email', 'tknusitubondo04@gmail.com');
                        $footerWa = preg_replace('/[^0-9]/', '', $footerTelp);
                        if (str_starts_with($footerWa, '0')) {
                            $footerWa = '62' . substr($footerWa, 1);
                        }
                    @endphp
                    <ul class="text-gray-400 space-y-4 text-sm">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-green-500 flex-shrink-0"></i>
                            <span class="leading-relaxed">{{ $footerAlamat }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fab fa-whatsapp mr-3 text-green-500 flex-shrink-0 text-base"></i>
                            <a href="https://wa.me/{{ $footerWa }}" target="_blank" class="hover:text-green-400 transition-colors">{{ $footerTelp }}</a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-green-500 flex-shrink-0"></i>
                            <a href="mailto:{{ $footerEmail }}" class="hover:text-green-400 transition-colors break-all">{{ $footerEmail }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <div class="mb-4 md:mb-0 text-center md:text-left">
                    &copy; {{ date('Y') }} <strong class="text-gray-400">TK NU 04 SITUBONDO</strong>. Hak Cipta Dilindungi.
                </div>
                <div class="text-center md:text-right">
                    Dibuat dengan <i class="fas fa-heart text-red-500 mx-1"></i> untuk pendidikan anak bangsa.
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

