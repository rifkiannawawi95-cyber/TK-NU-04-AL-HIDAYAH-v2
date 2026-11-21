@props(['judul' => 'LAPORAN KEHADIRAN', 'subjudul' => ''])

@php
    $logoSetting = \App\Models\SchoolSetting::get('logo_path');
    if ($logoSetting && Storage::disk('public')->exists($logoSetting)) {
        $logoData = Storage::url($logoSetting);
    } else {
        $logoPath = public_path('images/logo-nu.png');
        $logoData = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : asset('images/logo-nu.png');
    }
    $namaSekolah = \App\Models\SchoolSetting::get('nama_sekolah', 'TK NU 04 AL-HIDAYAH SITUBONDO');
    $namaYayasan = \App\Models\SchoolSetting::get('nama_yayasan', 'YAYASAN LP MA\'ARIF NU CABANG SITUBONDO');
    $alamatSekolah = \App\Models\SchoolSetting::get('alamat', 'Situbondo, Jawa Timur, Indonesia');
    $emailSekolah = \App\Models\SchoolSetting::get('email', 'tknusitubondo04@gmail.com');
    $teleponSekolah = \App\Models\SchoolSetting::get('telepon', '085334766072');
@endphp

<div class="kop-surat mb-6">
    <div style="display: flex; align-items: center; justify-content: center; gap: 20px; text-align: center; margin-bottom: 12px;">
        <img src="{{ $logoData }}" 
             alt="Logo Sekolah" 
             style="height: 75px; width: 75px; object-fit: contain; flex-shrink: 0;"
             class="h-16 w-16 sm:h-20 sm:w-20 object-contain flex-shrink-0">
        <div>
            <h4 style="margin: 0; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #374151;">
                {{ $namaYayasan }}
            </h4>
            <h2 style="margin: 4px 0 2px 0; font-size: 22px; font-weight: 900; color: #111827; letter-spacing: -0.5px;">
                {{ $namaSekolah }}
            </h2>
            <p style="margin: 0; font-size: 11px; color: #4b5563;">
                {{ $alamatSekolah }} | Email: {{ $emailSekolah }} | Telp: {{ $teleponSekolah }}
            </p>
        </div>
    </div>
    
    <!-- Garis Ganda Kop Surat Resmi -->
    <div style="border-bottom: 3px double #1f2937; margin-bottom: 16px;"></div>

    @if($judul)
    <div style="text-align: center; margin-top: 10px; margin-bottom: 16px;">
        <h3 style="margin: 0; font-size: 16px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; color: #111827;">
            {{ $judul }}
        </h3>
        @if($subjudul)
        <p style="margin: 4px 0 0 0; font-size: 13px; font-weight: 600; color: #4b5563;">
            {{ $subjudul }}
        </p>
        @endif
    </div>
    @endif
</div>
