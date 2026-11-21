<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TK NU 04 SITUBONDO | @yield('title', 'Dashboard Admin')</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Tailwind CSS & FontAwesome Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        nu: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#00875A', // NU Primary Green
                            700: '#006F4A',
                            800: '#00583A',
                            900: '#00422B',
                            950: '#00291B',
                        },
                        gold: {
                            400: '#FBBF24',
                            500: '#F59E0B',
                            600: '#D97706',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-transition { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 min-h-screen flex flex-col md:flex-row antialiased selection:bg-emerald-600 selection:text-white">

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div id="sidebar-backdrop" 
         class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-40 hidden md:hidden transition-opacity duration-300" 
         onclick="toggleSidebar()"></div>

    <!-- Modern Sidebar with Deep NU Emerald Green -->
    <aside id="sidebar" 
           class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-nu-900 via-nu-950 to-[#001f14] text-white flex flex-col transform -translate-x-full md:translate-x-0 md:static sidebar-transition shadow-2xl md:shadow-none flex-shrink-0 border-r border-nu-800/40">
        
        <!-- Logo Branding Header -->
        <div class="p-5 border-b border-nu-800/60 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl bg-white p-1 shadow-md border border-white/20 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                    <img src="{{ \App\Models\SchoolSetting::getPhoto('logo_path', 'images/logo-nu.png') }}" 
                         alt="Logo TK NU 04 SITUBONDO" 
                         class="w-full h-full object-contain">
                </div>
                <div class="overflow-hidden">
                    <span class="inline-block px-2 py-0.5 rounded-full text-[9px] font-extrabold uppercase tracking-wider bg-gold-400 text-slate-950 mb-0.5">
                        LP MA'ARIF NU
                    </span>
                    <h1 class="font-extrabold text-sm tracking-tight text-white leading-tight truncate">TK NU 04 SITUBONDO</h1>
                    <span class="text-[10px] text-emerald-300 font-semibold tracking-wider">Dashboard Panel</span>
                </div>
            </a>
            <button class="md:hidden text-emerald-300 hover:text-white w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center transition-colors" 
                    onclick="toggleSidebar()" 
                    aria-label="Tutup Menu">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>

        <!-- Role & User Profile Card in Sidebar -->
        <div class="mx-4 my-3 p-3 rounded-2xl bg-white/5 border border-white/10 flex items-center gap-3">
            <div class="relative flex-shrink-0">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-400 text-white flex items-center justify-center font-black text-sm shadow-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-400 border-2 border-nu-950 rounded-full"></span>
            </div>
            <div class="overflow-hidden flex-1">
                <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                <div class="flex items-center gap-1.5 mt-0.5">
                    <span class="px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider {{ auth()->user()->isAdmin() ? 'bg-gold-400/90 text-slate-950' : 'bg-emerald-500 text-white' }}">
                        {{ auth()->user()->isAdmin() ? 'Administrator' : 'Guru / User' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Navigation Links (Scrollable with Sleek Styling) -->
        <nav class="flex-1 overflow-y-auto px-4 py-3 space-y-1 text-xs font-medium">
            @if(auth()->user()->isAdmin())
                <div class="px-3 py-1 text-[10px] uppercase font-extrabold tracking-wider text-emerald-400/80">Menu Utama</div>
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-grid-2 w-5 text-center text-gold-400 text-sm"></i> 
                    <span>Dashboard Utama</span>
                </a>

                <div class="px-3 pt-3 pb-1 text-[10px] uppercase font-extrabold tracking-wider text-emerald-400/80">Data Master</div>
                <a href="{{ route('admin.siswa.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.siswa.*') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-children w-5 text-center text-sky-300 text-sm"></i> 
                    <span>Data Siswa</span>
                </a>
                <a href="{{ route('admin.guru.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.guru.*') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-chalkboard-teacher w-5 text-center text-emerald-300 text-sm"></i> 
                    <span>Data Guru & Staf</span>
                </a>
                <a href="{{ route('admin.kehadiranguru.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.kehadiranguru.*') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-clipboard-user w-5 text-center text-teal-300 text-sm"></i> 
                    <span>Presensi & Absensi</span>
                </a>

                <div class="px-3 pt-3 pb-1 text-[10px] uppercase font-extrabold tracking-wider text-emerald-400/80">Aktivitas & Media</div>
                <a href="{{ route('admin.galeri.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.galeri.*') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-images w-5 text-center text-cyan-300 text-sm"></i> 
                    <span>Galeri Foto Kegiatan</span>
                    <span class="ml-auto px-2 py-0.5 rounded-full text-[10px] font-black bg-cyan-400/20 text-cyan-300 border border-cyan-400/30">
                        Media
                    </span>
                </a>
                <a href="{{ route('admin.acara.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.acara.*') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-calendar-star w-5 text-center text-amber-300 text-sm"></i> 
                    <span>Agenda & Acara</span>
                </a>
                <a href="{{ route('admin.kalender.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.kalender.*') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-calendar-days w-5 text-center text-violet-300 text-sm"></i> 
                    <span>Kalender Akademik</span>
                </a>
                <a href="{{ route('admin.prestasi.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.prestasi.*') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-trophy w-5 text-center text-gold-400 text-sm"></i> 
                    <span>Prestasi Santri</span>
                </a>
                <a href="{{ route('admin.testimoni.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.testimoni.*') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-comments w-5 text-center text-pink-300 text-sm"></i> 
                    <span>Testimoni Wali</span>
                    @php 
                        $badgePending = \App\Models\Testimoni::where('is_approved', false)->count(); 
                    @endphp
                    @if($badgePending > 0)
                        <span class="ml-auto px-2 py-0.5 rounded-full text-[10px] font-black bg-amber-400 text-slate-950 animate-pulse">
                            {{ $badgePending }} Baru
                        </span>
                    @endif
                </a>

                <div class="px-3 pt-3 pb-1 text-[10px] uppercase font-extrabold tracking-wider text-emerald-400/80">Laporan & Konfigurasi</div>
                <a href="{{ route('admin.laporan.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.laporan.*') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-file-chart-column w-5 text-center text-rose-300 text-sm"></i> 
                    <span>Laporan & Rekap</span>
                </a>
                <a href="{{ route('admin.setting.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('admin.setting.*') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-sliders w-5 text-center text-slate-300 text-sm"></i> 
                    <span>Pengaturan Sekolah</span>
                </a>
            @else
                <div class="px-3 py-1 text-[10px] uppercase font-extrabold tracking-wider text-emerald-400/80">Menu Guru</div>
                <a href="{{ route('user.dashboard') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('user.dashboard') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-grid-2 w-5 text-center text-gold-400 text-sm"></i> 
                    <span>Dashboard Guru</span>
                </a>
                <a href="{{ route('user.siswa.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('user.siswa.*') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-children w-5 text-center text-sky-300 text-sm"></i> 
                    <span>Data Siswa Kelas</span>
                </a>
                <a href="{{ route('user.kehadiransiswa.index') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('user.kehadiransiswa.index') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-calendar-check w-5 text-center text-emerald-300 text-sm"></i> 
                    <span>Input Presensi Siswa</span>
                </a>
                <a href="{{ route('user.kehadiransiswa.rekap') }}" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl transition-all {{ request()->routeIs('user.kehadiransiswa.rekap') ? 'bg-gradient-to-r from-emerald-600 to-nu-600 text-white font-bold shadow-lg shadow-emerald-900/40' : 'text-emerald-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-file-invoice w-5 text-center text-teal-300 text-sm"></i> 
                    <span>Rekap & Cetak Kehadiran</span>
                </a>
            @endif

            <!-- Direct Link to Public Portal -->
            <div class="pt-4">
                <a href="/" target="_blank" 
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-2xl text-emerald-200 hover:text-white hover:bg-white/10 transition-all border border-nu-700/60 group">
                    <i class="fas fa-globe w-5 text-center text-emerald-400 group-hover:rotate-45 transition-transform"></i> 
                    <span>Website Publik</span>
                    <i class="fas fa-arrow-up-right-from-square text-[10px] ml-auto opacity-60"></i>
                </a>
            </div>
        </nav>

        <!-- Sidebar Footer Action -->
        <div class="p-4 border-t border-nu-800/60 bg-black/20">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="w-full bg-rose-600/90 hover:bg-rose-600 text-white text-xs font-bold py-2.5 px-4 rounded-xl transition-all flex items-center justify-center gap-2 shadow-sm hover:shadow">
                    <i class="fas fa-arrow-right-from-bracket"></i> Keluar (Logout)
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Container -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- Topbar Navbar (Clean Glassmorphism) -->
        <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/80 px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-3">
                <!-- Mobile Hamburger Button -->
                <button class="md:hidden text-slate-700 hover:text-slate-900 p-2 rounded-xl hover:bg-slate-100 transition-colors focus:outline-none" 
                        onclick="toggleSidebar()" 
                        aria-label="Buka Menu Navigasi">
                    <i class="fas fa-bars-staggered text-lg"></i>
                </button>

                <!-- Page Header Title & Breadcrumb -->
                <div>
                    <h1 class="text-base sm:text-lg font-black text-slate-800 tracking-tight flex items-center gap-2">
                        @yield('header', 'Dashboard')
                    </h1>
                    <p class="text-[11px] text-slate-400 font-medium hidden sm:block">
                        TK NU 04 SITUBONDO &bull; LP Ma'arif Cabang Situbondo
                    </p>
                </div>
            </div>

            <!-- Right Navbar Information -->
            <div class="flex items-center gap-3 sm:gap-4">
                
                <!-- Live Calendar & Date Pill -->
                <div class="hidden sm:flex items-center gap-2 text-xs font-semibold text-slate-600 bg-slate-100/80 px-3.5 py-1.5 rounded-full border border-slate-200/60">
                    <i class="far fa-calendar-check text-emerald-600"></i>
                    <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>

                <!-- Quick Storage Link Checker Button -->
                <a href="/setup-galeri-storage.php" 
                   target="_blank"
                   title="Periksa Status Storage & Media" 
                   class="hidden lg:flex items-center gap-1.5 text-[11px] font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-full border border-emerald-200 transition-colors">
                    <i class="fas fa-shield-check text-emerald-600"></i> Status Media
                </a>

                <!-- User Profile Pill -->
                <div class="flex items-center gap-2 pl-2 border-l border-slate-200">
                    <div class="w-8 h-8 rounded-xl bg-nu-600 text-white flex items-center justify-center font-black text-xs shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <span class="block text-xs font-bold text-slate-800 leading-tight">{{ auth()->user()->name }}</span>
                        <span class="block text-[10px] text-emerald-600 font-semibold">{{ auth()->user()->isAdmin() ? 'Administrator' : 'Tenaga Pendidik' }}</span>
                    </div>
                </div>

            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-3.5 rounded-2xl mb-6 flex items-start gap-3 shadow-xs animate-fade-in" role="alert">
                    <i class="fas fa-circle-check text-emerald-600 text-lg mt-0.5 flex-shrink-0"></i>
                    <div class="text-xs sm:text-sm font-semibold">
                        <strong class="font-extrabold">Berhasil!</strong> {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-3.5 rounded-2xl mb-6 flex items-start gap-3 shadow-xs animate-fade-in" role="alert">
                    <i class="fas fa-circle-exclamation text-rose-600 text-lg mt-0.5 flex-shrink-0"></i>
                    <div class="text-xs sm:text-sm font-semibold">
                        <strong class="font-extrabold">Peringatan:</strong> {{ session('error') }}
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-5 py-4 rounded-2xl mb-6 shadow-xs animate-fade-in" role="alert">
                    <div class="flex items-center gap-2 mb-2 font-black text-xs sm:text-sm">
                        <i class="fas fa-triangle-exclamation text-rose-600"></i> Mohon periksa kembali formulir isian:
                    </div>
                    <ul class="list-disc pl-5 text-xs space-y-1 text-rose-700 font-medium">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Mobile Drawer & UI Javascript -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        // Close drawer with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById('sidebar');
                if (sidebar && !sidebar.classList.contains('-translate-x-full') && window.innerWidth < 768) {
                    toggleSidebar();
                }
            }
        });
    </script>
</body>
</html>
