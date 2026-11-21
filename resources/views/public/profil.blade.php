@extends('layouts.public')
@section('title', 'Profil Sekolah - TK NU 04 SITUBONDO')
@section('content')

<!-- Header Banner -->
<div class="bg-gradient-to-b from-[#eaf6ed] via-[#f0fdf4] to-white py-12 lg:py-16 border-b border-emerald-100/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <div class="inline-flex items-center gap-2 bg-emerald-100/80 border border-emerald-200/60 px-4 py-1.5 rounded-full text-[#0f3c2b] text-xs font-bold tracking-wide mb-4">
            <i class="fas fa-school text-emerald-600"></i> Lembaga Pendidikan Anak Usia Dini
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#0f3c2b] tracking-tight mb-4">
            Profil Sekolah TK NU 04 SITUBONDO
        </h1>
        <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto font-medium">
            Mengenal lebih dekat sejarah, visi, misi, tujuan, dan informasi lembaga TK NU 04 SITUBONDO.
        </p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10">

    <!-- 1. Nama Sekolah dan Alamat Card -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6 sm:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6" data-aos="fade-up">
        <div class="flex items-start sm:items-center gap-4">
            <img src="{{ \App\Models\SchoolSetting::getPhoto('logo_path', 'images/logo-nu.png') }}" alt="Logo NU TK AL-HIDAYAH" class="w-16 h-16 sm:w-20 sm:h-20 object-contain rounded-2xl shadow-sm p-1 bg-white border border-emerald-100 flex-shrink-0">
            <div>
                <h2 class="text-2xl sm:text-3xl font-black text-[#0f3c2b] tracking-tight">{{ \App\Models\SchoolSetting::get('nama_sekolah', 'TK NU 04 AL-HIDAYAH SITUBONDO') }}</h2>
                <div class="flex items-start sm:items-center gap-2 mt-1.5 text-gray-600 text-sm sm:text-base font-medium">
                    <i class="fas fa-map-marker-alt text-emerald-600 mt-1 sm:mt-0 flex-shrink-0"></i>
                    <div>
                        <strong class="font-bold text-gray-900">Alamat:</strong>
                        <span class="block sm:inline">{{ \App\Models\SchoolSetting::get('alamat', 'Situbondo, Jawa Timur, Indonesia') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap gap-2 pt-4 md:pt-0 border-t md:border-t-0 border-gray-100">
            <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                <i class="fas fa-check-circle mr-1.5 text-emerald-600"></i> Terdaftar Resmi
            </span>
            <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                <i class="fas fa-shield-alt mr-1.5 text-amber-600"></i> LP Ma'arif NU
            </span>
        </div>
    </div>

    <!-- 2. Deskripsi Singkat / Profil Sekolah -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6 sm:p-10" data-aos="fade-up" data-aos-delay="100">
        <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
            <div class="w-10 h-10 rounded-2xl bg-[#046c4e] text-white flex items-center justify-center text-lg font-bold shadow-sm">
                <i class="fas fa-book-open"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Sejarah & Gambaran Sekolah</h2>
                <p class="text-xs text-gray-500 font-medium">Perjalanan dan latar belakang {{ \App\Models\SchoolSetting::get('nama_sekolah', 'TK NU 04 SITUBONDO') }}</p>
            </div>
        </div>

        <div class="mb-8 rounded-3xl overflow-hidden shadow-lg border-2 border-emerald-100 max-h-96 relative group">
            <img src="{{ \App\Models\SchoolSetting::getPhoto('school_image', 'img/sekolah.jpg') }}" alt="Gedung {{ \App\Models\SchoolSetting::get('nama_sekolah', 'TK NU 04 SITUBONDO') }}" class="w-full h-80 sm:h-96 object-cover group-hover:scale-105 transition-transform duration-700">
            <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent p-4 text-white flex items-center gap-2 text-sm font-semibold">
                <i class="fas fa-camera text-emerald-400"></i> Gedung & Lingkungan {{ \App\Models\SchoolSetting::get('nama_sekolah', 'TK NU 04 SITUBONDO') }}
            </div>
        </div>

        <div class="space-y-6 text-gray-700 leading-relaxed text-base font-medium">
            <p>
                Pada awal berdirinya bernama <strong class="text-gray-900">TK AL-HIDAYAH IV</strong> pada tahun 1990 dengan bernaung di bawah <strong class="text-gray-900">Yayasan LP Ma'arif NU Cabang Situbondo</strong>. Kepala TK pertama dipimpin oleh Ibu Siti Noer Loeky F. (1990–1994), kemudian digantikan oleh Ibu Ummi Kudratillah (1994–1998), lalu Ibu Siti Mulyani, S.Pd. (1999–2020), dan saat ini dipimpin oleh <strong class="text-gray-900">Ibu Siti Hanawiyun Nasyiin, S.Pd.</strong> (2021–sekarang).
            </p>
            <p>
                Sekolah beralamatkan di Jalan Olean RT 005 RW 003, Desa Olean, Kecamatan Situbondo, Kabupaten Situbondo dengan piagam pendirian sebagai sekolah terdaftar dari Kantor Pendidikan dan Kebudayaan Kabupaten Situbondo No. <span class="font-mono bg-gray-100 px-2.5 py-0.5 rounded text-sm text-gray-800 border border-gray-200">6289/104.31/B3/1994</span>. Berdasarkan peraturan pemerintah mengenai legalitas lembaga, nama TK AL-HIDAYAH IV secara resmi disesuaikan menjadi <strong class="text-emerald-700">TK NU 04 SITUBONDO</strong>.
            </p>
            <p>
                TK NU 04 SITUBONDO melayani peserta didik berusia 4–6 tahun yang terbagi menjadi 2 kelompok belajar (Kelompok A dan B). Pada tahun pelajaran 2025/2026, lembaga ini mendidik 66 peserta didik (35 anak Kelompok A dan 31 anak Kelompok B) dalam 4 rombongan belajar.
            </p>
            <p>
                Lembaga ini berdiri di atas tanah milik sendiri seluas 1.475 m² dengan bangunan permanen yang dilengkapi fasilitas bermain outdoor seperti perosotan, jungkitan, ayunan, dan mangkok putar. Bangunan sekolah memiliki 5 ruangan (1 ruang guru & kantor kepala sekolah, serta 4 ruang kelas), dilengkapi 2 kamar mandi dan 2 tempat cuci tangan.
            </p>
            <p>
                Kepercayaan masyarakat sekitar terhadap sekolah sangat tinggi. Kurikulum operasional sekolah disusun oleh Tim Pengembang Kurikulum (Yayasan, Guru, Kepala Sekolah, dan Paguyuban Sekolah) yang mengacu pada tujuan pendidikan nasional dengan memperhatikan kekhasan daerah serta karakter anak usia dini.
            </p>
        </div>

        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 pt-6 border-t border-gray-100">
            <div class="bg-emerald-50/70 p-4 rounded-2xl text-center border border-emerald-100">
                <span class="block text-2xl font-black text-emerald-700">66</span>
                <span class="text-xs text-gray-600 font-bold">Peserta Didik</span>
            </div>
            <div class="bg-emerald-50/70 p-4 rounded-2xl text-center border border-emerald-100">
                <span class="block text-2xl font-black text-emerald-700">4</span>
                <span class="text-xs text-gray-600 font-bold">Rombongan Belajar</span>
            </div>
            <div class="bg-teal-50/70 p-4 rounded-2xl text-center border border-teal-100">
                <span class="block text-2xl font-black text-teal-700">1.475 m²</span>
                <span class="text-xs text-gray-600 font-bold">Luas Lahan</span>
            </div>
            <div class="bg-amber-50/70 p-4 rounded-2xl text-center border border-amber-100">
                <span class="block text-2xl font-black text-amber-700">5</span>
                <span class="text-xs text-gray-600 font-bold">Tenaga Pendidik & Staf</span>
            </div>
        </div>
    </div>

    <!-- 3. Tujuan Sekolah, Visi & Misi -->
    <div class="space-y-6" data-aos="fade-up" data-aos-delay="150">
        <div class="text-center sm:text-left">
            <h2 class="text-2xl font-black text-[#0f3c2b] flex items-center justify-center sm:justify-start gap-2">
                <i class="fas fa-compass text-emerald-600"></i> Tujuan, Visi & Misi Sekolah
            </h2>
            <p class="text-sm text-gray-500 mt-1 font-medium">Arah dan komitmen pendidikan di TK NU 04 SITUBONDO</p>
        </div>

        <!-- Card for Tujuan Sekolah -->
        <div class="bg-gradient-to-br from-[#0f3c2b] via-[#046c4e] to-emerald-900 text-white rounded-3xl p-6 sm:p-8 shadow-xl relative overflow-hidden">
            <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400 text-emerald-950 flex items-center justify-center text-xl font-bold shadow-md">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <div>
                        <span class="text-xs uppercase font-extrabold tracking-widest text-amber-300">Komitmen Utama</span>
                        <h3 class="text-2xl font-black text-white">Tujuan Sekolah</h3>
                    </div>
                </div>
                <blockquote class="text-base sm:text-lg text-emerald-50 font-medium leading-relaxed pl-4 border-l-4 border-amber-400 italic bg-white/5 p-4 rounded-r-2xl">
                    "{{ \App\Models\SchoolSetting::get('tujuan', 'Menjadi lembaga pendidikan anak usia dini yang mampu memberikan pendidikan yang berkualitas, membentuk anak yang beriman, berakhlak mulia, mandiri, kreatif, sehat, serta memiliki kemampuan sosial dan emosional yang baik.') }}"
                </blockquote>
            </div>
        </div>

        <!-- Grid for Visi & Misi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Card Visi -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-emerald-100 shadow-xl hover:shadow-2xl transition-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-lg font-bold">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Visi</h3>
                </div>
                <p class="text-gray-700 font-medium italic bg-emerald-50/60 p-4 rounded-2xl border border-emerald-100 leading-relaxed">
                    "{{ \App\Models\SchoolSetting::get('visi', 'Mencetak generasi yang cerdas, ceria, kreatif dan berakhlak mulia.') }}"
                </p>
            </div>

            <!-- Card Misi -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-amber-100 shadow-xl hover:shadow-2xl transition-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-800 flex items-center justify-center text-lg font-bold">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Misi</h3>
                </div>
                @if(\App\Models\SchoolSetting::get('misi'))
                    <div class="text-gray-700 text-sm sm:text-base font-medium whitespace-pre-line leading-relaxed">
                        {{ \App\Models\SchoolSetting::get('misi') }}
                    </div>
                @else
                    <ul class="space-y-3 text-gray-700 text-sm sm:text-base font-medium">
                        <li class="flex items-start gap-2.5">
                            <i class="fas fa-check-circle text-emerald-600 mt-1 flex-shrink-0"></i>
                            <span>Cerdas dalam mengembangkan seluruh kemampuan perkembangan anak.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <i class="fas fa-check-circle text-emerald-600 mt-1 flex-shrink-0"></i>
                            <span>Menggali kreativitas anak melalui belajar yang menyenangkan.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <i class="fas fa-check-circle text-emerald-600 mt-1 flex-shrink-0"></i>
                            <span>Menanamkan sikap dan perilaku yang berakhlak mulia.</span>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <!-- 4. Tenaga Pendidik & Kependidikan (Dewan Guru & Staf) -->
    <div class="space-y-6" data-aos="fade-up" data-aos-delay="180">
        <div class="text-center sm:text-left">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-black uppercase tracking-wider mb-2 border border-emerald-200/60">
                <i class="fas fa-chalkboard-teacher text-emerald-600"></i> Pendidik Berdedikasi
            </div>
            <h2 class="text-2xl sm:text-3xl font-black text-[#0f3c2b] flex items-center justify-center sm:justify-start gap-2">
                Dewan Guru & Tenaga Kependidikan
            </h2>
            <p class="text-sm text-gray-500 mt-1 font-medium">Para ustadzah dan pendidik berhati tulus yang mendampingi tumbuh kembang ananda dengan penuh kasih sayang.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($gurus as $guru)
                <div class="bg-white rounded-3xl p-6 border border-emerald-100 shadow-md hover:shadow-xl transition-all duration-300 flex flex-col items-center text-center group hover:-translate-y-1">
                    <!-- Foto Guru dengan Frame Bulat Elegan -->
                    <div class="relative w-28 h-28 mb-3 rounded-full overflow-hidden border-4 border-emerald-100 shadow-sm group-hover:border-emerald-300 transition-colors bg-emerald-50 flex-shrink-0">
                        <img src="{{ $guru->foto_url }}" 
                             alt="{{ $guru->nama }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                             loading="lazy"
                             onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.svg') }}';">
                    </div>

                    <!-- Nama Guru Saja -->
                    <h3 class="text-base font-black text-slate-800 leading-snug group-hover:text-emerald-700 transition-colors">
                        {{ $guru->nama }}
                    </h3>
                </div>
            @empty
                <div class="col-span-full py-10 text-center text-slate-400 bg-white rounded-3xl border border-dashed border-slate-200">
                    <i class="fas fa-users text-3xl mb-2 text-slate-300"></i>
                    <p class="font-bold text-sm">Data dewan guru akan segera diperbarui.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- 5. Informasi Sekolah -->
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6 sm:p-8" data-aos="fade-up" data-aos-delay="200">
        <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
            <div class="w-10 h-10 rounded-2xl bg-[#046c4e] text-white flex items-center justify-center text-lg font-bold">
                <i class="fas fa-info-circle"></i>
            </div>
            <div>
                <h3 class="text-2xl font-bold text-gray-900">Informasi Sekolah</h3>
                <p class="text-xs text-gray-500 font-medium">Detail identitas dan kontak {{ \App\Models\SchoolSetting::get('nama_sekolah', 'TK NU 04 SITUBONDO') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700 text-sm sm:text-base font-medium">
            <div class="space-y-4">
                <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-gray-50/80 border border-gray-100">
                    <i class="fas fa-school text-emerald-600 mt-1 text-lg w-5 text-center flex-shrink-0"></i>
                    <div>
                        <span class="text-xs text-gray-500 font-bold block uppercase tracking-wider">Nama Sekolah</span>
                        <span class="font-extrabold text-gray-900">{{ \App\Models\SchoolSetting::get('nama_sekolah', 'TK NU 04 AL-HIDAYAH SITUBONDO') }}</span>
                    </div>
                </div>

                {{-- Kepala Sekolah Card with Photo --}}
                <div class="flex items-center gap-3.5 p-3.5 rounded-2xl bg-gray-50/80 border border-gray-100">
                    @php
                        $ksPhoto = \App\Models\SchoolSetting::get('kepala_sekolah_photo');
                    @endphp
                    @if($ksPhoto && Storage::disk('public')->exists($ksPhoto))
                        <img src="{{ asset('storage/' . $ksPhoto) }}" alt="Kepala Sekolah" class="w-12 h-12 rounded-full object-cover border-2 border-emerald-500 flex-shrink-0 shadow-sm">
                    @else
                        <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    @endif
                    <div>
                        <span class="text-xs text-gray-500 font-bold block uppercase tracking-wider">Kepala Sekolah</span>
                        <span class="font-bold text-gray-900">{{ \App\Models\SchoolSetting::get('kepala_sekolah', 'Ibu Siti Hanawiyun Nasyiin, S.Pd') }}</span>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-gray-50/80 border border-gray-100">
                    <i class="fas fa-building text-emerald-600 mt-1 text-lg w-5 text-center flex-shrink-0"></i>
                    <div>
                        <span class="text-xs text-gray-500 font-bold block uppercase tracking-wider">Yayasan Naungan</span>
                        <span class="font-bold text-gray-900">{{ \App\Models\SchoolSetting::get('nama_yayasan', 'YAYASAN LP MA\'ARIF NU CABANG SITUBONDO') }}</span>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-gray-50/80 border border-gray-100">
                    <i class="fas fa-map-marker-alt text-emerald-600 mt-1 text-lg w-5 text-center flex-shrink-0"></i>
                    <div>
                        <span class="text-xs text-gray-500 font-bold block uppercase tracking-wider">Alamat Lengkap</span>
                        <span class="font-bold text-gray-900 leading-snug">
                            {{ \App\Models\SchoolSetting::get('alamat', '82H9+7FV, Jl. Raya Olean, Olean Tengah, Olean, Kec. Situbondo, Kabupaten Situbondo, Jawa Timur 68316') }}
                        </span>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-gray-50/80 border border-gray-100">
                    <i class="fas fa-phone-alt text-emerald-600 mt-1 text-lg w-5 text-center flex-shrink-0"></i>
                    <div>
                        <span class="text-xs text-gray-500 font-bold block uppercase tracking-wider">Telepon / WhatsApp</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SchoolSetting::get('telepon', '085334766072')) }}" target="_blank" class="font-extrabold text-emerald-700 hover:underline">
                            {{ \App\Models\SchoolSetting::get('telepon', '085334766072') }}
                        </a>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-gray-50/80 border border-gray-100">
                    <i class="fas fa-envelope text-emerald-600 mt-1 text-lg w-5 text-center flex-shrink-0"></i>
                    <div>
                        <span class="text-xs text-gray-500 font-bold block uppercase tracking-wider">Email Resmi</span>
                        <a href="mailto:{{ \App\Models\SchoolSetting::get('email', 'tknusitubondo04@gmail.com') }}" class="font-bold text-emerald-700 hover:underline break-all">
                            {{ \App\Models\SchoolSetting::get('email', 'tknusitubondo04@gmail.com') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
