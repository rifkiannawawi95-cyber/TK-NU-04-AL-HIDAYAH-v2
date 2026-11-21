<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TK NU 04 SITUBONDO</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    
    <!-- Tailwind CSS & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-green-900 via-green-800 to-emerald-950 flex items-center justify-center min-h-screen p-4 antialiased selection:bg-green-600 selection:text-white">
    <div class="relative w-full max-w-md">
        <!-- Ambient Decorative Glow -->
        <div class="absolute -top-12 -left-12 w-48 h-48 bg-yellow-400 opacity-20 blur-3xl rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-12 -right-12 w-48 h-48 bg-green-400 opacity-20 blur-3xl rounded-full pointer-events-none"></div>

        <div class="bg-white/95 backdrop-blur-xl p-8 sm:p-10 rounded-3xl shadow-2xl border border-white/20 relative z-10">
            <!-- Header with Official Logo -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block mb-3 group">
                    <img src="{{ \App\Models\SchoolSetting::get('logo_path') ? Storage::url(\App\Models\SchoolSetting::get('logo_path')) : asset('images/logo-nu.png') }}" alt="Logo TK NU 04 AL-HIDAYAH" class="h-24 w-auto mx-auto drop-shadow-md transition-transform duration-300 group-hover:scale-105 object-contain">
                </a>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ \App\Models\SchoolSetting::get('nama_sekolah', 'TK NU 04 AL-HIDAYAH') }}</h1>
                <p class="text-xs font-semibold text-emerald-800 bg-emerald-50 inline-block px-3 py-1 rounded-full mt-1.5 border border-emerald-200">
                    Sistem Informasi TK NU 04 SITUBONDO
                </p>
            </div>

            @if($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 rounded-2xl mb-6 text-xs shadow-xs">
                    <div class="flex items-center gap-2 font-bold mb-1 text-rose-900">
                        <i class="fas fa-exclamation-circle text-rose-600"></i> Login Gagal:
                    </div>
                    @foreach($errors->all() as $error)
                        <p class="text-rose-700 font-medium">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" onsubmit="handleLoginSubmit(event)">
                @csrf
                <div class="mb-5">
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <input type="email" name="email" id="email" class="pl-10 pr-4 w-full rounded-xl border border-gray-300 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all bg-gray-50/50 focus:bg-white" placeholder="admin@example.com" required value="{{ old('email') }}">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-gray-700 mb-2">Kata Sandi / Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-lock"></i>
                        </div>
                        <input type="password" name="password" id="password" class="pl-10 pr-4 w-full rounded-xl border border-gray-300 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition-all bg-gray-50/50 focus:bg-white" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" id="submit-btn" class="w-full bg-gradient-to-r from-green-700 to-emerald-600 hover:from-green-800 hover:to-emerald-700 text-white font-extrabold py-3.5 px-4 rounded-xl shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <span id="btn-text">Masuk ke Sistem</span>
                    <i class="fas fa-arrow-right text-xs" id="btn-icon"></i>
                </button>
            </form>

            <div class="text-center mt-6 pt-6 border-t border-gray-100">
                <a href="/" class="text-xs font-bold text-gray-600 hover:text-green-700 transition-colors inline-flex items-center gap-1.5">
                    <i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>

    <script>
        function handleLoginSubmit(e) {
            var btn = document.getElementById('submit-btn');
            var btnText = document.getElementById('btn-text');
            var btnIcon = document.getElementById('btn-icon');
            btn.disabled = true;
            btnText.innerText = 'Memproses Login...';
            btnIcon.className = 'fas fa-spinner fa-spin text-xs';
        }
    </script>
</body>
</html>

