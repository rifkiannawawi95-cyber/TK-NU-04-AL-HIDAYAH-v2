@extends('layouts.admin')
@section('title', 'Pengaturan Sistem')
@section('header', 'Pengaturan Sistem')
@section('content')

<style>
.tab-btn {
    padding: 0.625rem 1.25rem;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: 0.75rem;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
    background: transparent;
}
.tab-btn.active { background: #15803d; color: #fff; box-shadow: 0 2px 8px rgba(21,128,61,0.3); }
.tab-btn:not(.active) { color: #4b5563; }
.tab-btn:not(.active):hover { background: #f3f4f6; }

.setting-card {
    background: #fff;
    border-radius: 1.25rem;
    border: 1px solid #f0f0f0;
    box-shadow: 0 2px 16px 0 rgba(0,0,0,0.05);
    padding: 2rem;
    margin-bottom: 1.5rem;
}
.form-label {
    display: block;
    font-size: 0.78rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #64748b;
    margin-bottom: 0.4rem;
}
.form-input {
    width: 100%;
    padding: 0.55rem 0.85rem;
    border: 1.5px solid #e2e8f0;
    border-radius: 0.6rem;
    font-size: 0.92rem;
    color: #1e293b;
    background: #f8fafc;
    transition: border-color 0.2s;
    outline: none;
}
.form-input:focus { border-color: #16a34a; background: #fff; box-shadow: 0 0 0 3px rgba(22,163,74,0.08); }
.form-textarea { min-height: 90px; resize: vertical; }
.btn-save {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #16a34a, #059669);
    color: #fff;
    font-weight: 700;
    font-size: 0.88rem;
    padding: 0.6rem 1.4rem;
    border-radius: 0.7rem;
    border: none;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(22,163,74,0.25);
    transition: all 0.2s;
}
.btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(22,163,74,0.3); }
.logo-preview {
    width: 100px;
    height: 100px;
    object-fit: contain;
    border-radius: 1rem;
    border: 2px solid #e2e8f0;
    background: #f8fafc;
    padding: 0.4rem;
    box-shadow: 0 1px 6px rgba(0,0,0,0.06);
}
.upload-zone {
    border: 2px dashed #cbd5e1;
    border-radius: 0.75rem;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s;
    background: #f8fafc;
}
.upload-zone:hover { border-color: #16a34a; background: #f0fdf4; }
.guru-card {
    background: #fff;
    border: 1.5px solid #f1f5f9;
    border-radius: 1rem;
    padding: 1rem 1.25rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: box-shadow 0.2s, border-color 0.2s;
}
.guru-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.08); border-color: #d1fae5; }
</style>

{{-- Page Header --}}
<div class="bg-gradient-to-r from-green-900 via-green-800 to-emerald-900 rounded-2xl p-6 text-white mb-6 shadow-md border border-green-700/40 relative overflow-hidden">
    <div class="absolute -right-8 -bottom-8 w-36 h-36 bg-green-500/10 rounded-full blur-2xl pointer-events-none"></div>
    <div class="flex items-center gap-4 relative z-10">
        <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center text-2xl backdrop-blur-sm shadow">
            <i class="fas fa-cog text-amber-300"></i>
        </div>
        <div>
            <h2 class="text-xl font-extrabold tracking-tight">Pengaturan Sistem</h2>
            <p class="text-sm text-green-200 mt-0.5">Kelola logo, profil sekolah, dan data pengajar</p>
        </div>
    </div>
</div>

{{-- Tab Navigation --}}
<div class="flex flex-wrap gap-2 mb-6 bg-white rounded-2xl p-2 shadow-sm border border-gray-100 w-fit">
    <button onclick="showTab('tab-foto')" id="btn-foto" class="tab-btn active">
        <i class="fas fa-images mr-2"></i> Foto Website & Beranda
    </button>
    <button onclick="showTab('tab-profil')" id="btn-profil" class="tab-btn">
        <i class="fas fa-school mr-2"></i> Profil Sekolah
    </button>
    <button onclick="showTab('tab-logo')" id="btn-logo" class="tab-btn">
        <i class="fas fa-certificate mr-2"></i> Logo Sekolah
    </button>
    <button onclick="showTab('tab-guru')" id="btn-guru" class="tab-btn">
        <i class="fas fa-chalkboard-teacher mr-2"></i> Data Pengajar
    </button>
</div>

{{-- ===================== TAB 1: FOTO & MEDIA WEBSITE ===================== --}}
<div id="tab-foto" class="tab-content">
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-start gap-3">
        <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0 mt-0.5 shadow-sm">
            <i class="fas fa-info-circle"></i>
        </div>
        <div>
            <h4 class="text-sm font-bold text-emerald-950">Atur Semua Foto di Halaman Depan & Website</h4>
            <p class="text-xs text-emerald-800 mt-0.5 leading-relaxed">
                Semua foto yang tampil di website publik (halaman Beranda, Profil, dll) dapat diubah langsung melalui halaman ini tanpa perlu mengubah codingan lagi. Cukup unggah foto baru dan simpan!
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        {{-- Card 1: Foto Banner Beranda (Hero Section) --}}
        <div class="setting-card mb-0">
            <div class="flex items-center justify-between pb-3 mb-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-lg">
                        <i class="fas fa-image"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-base">Foto Banner Beranda</h4>
                        <p class="text-xs text-gray-500">Tampil di bagian paling atas Beranda (Hero Kanan)</p>
                    </div>
                </div>
                @php
                    $heroVal = $settings['hero_image'] ?? null;
                    $isHeroCustom = $heroVal && Storage::disk('public')->exists($heroVal);
                    $heroPreview = $isHeroCustom ? Storage::url($heroVal) : (file_exists(public_path('img/hero_kids.jpg')) ? asset('img/hero_kids.jpg') : asset('images/logo-nu.png'));
                @endphp
                @if($isHeroCustom)
                    <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-emerald-100 text-emerald-800">Foto Kustom</span>
                @else
                    <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-gray-100 text-gray-600">Default Sistem</span>
                @endif
            </div>

            <div class="flex flex-col sm:flex-row gap-5 items-start">
                <div class="flex flex-col items-center gap-2 flex-shrink-0 w-full sm:w-auto">
                    <img id="preview_hero" src="{{ $heroPreview }}" alt="Banner Beranda" class="w-full sm:w-44 h-32 object-cover rounded-xl border-2 border-gray-200 shadow-sm bg-gray-50">
                    @if($isHeroCustom)
                        <form action="{{ route('admin.setting.photo.reset', 'hero_image') }}" method="POST" onsubmit="return confirm('Kembalikan foto banner ke foto bawaan sistem?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-rose-600 hover:text-rose-800 font-semibold hover:underline flex items-center gap-1 mt-1">
                                <i class="fas fa-undo"></i> Kembalikan Default
                            </button>
                        </form>
                    @endif
                </div>

                <div class="flex-1 w-full">
                    <form action="{{ route('admin.setting.photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="key" value="hero_image">
                        <label class="form-label">Unggah Foto Baru</label>
                        <div class="upload-zone" onclick="document.getElementById('input_hero').click()">
                            <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-1"></i>
                            <p class="text-xs text-gray-600 font-semibold">Klik untuk pilih foto</p>
                            <p class="text-[10px] text-gray-400 mt-0.5">JPG, PNG, WebP (Maks: 3MB)</p>
                            <input type="file" id="input_hero" name="photo" accept="image/*" class="hidden" onchange="previewImg(this, 'preview_hero', 'file_hero')">
                            <div id="file_hero" class="hidden mt-2 px-2.5 py-1 bg-green-50 border border-green-200 rounded text-[11px] text-green-700 font-medium"></div>
                        </div>
                        <div class="mt-3 flex justify-end">
                            <button type="submit" class="btn-save text-xs py-2 px-4">
                                <i class="fas fa-save"></i> Simpan Foto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Card 2: Foto Gedung & Lingkungan Sekolah --}}
        <div class="setting-card mb-0">
            <div class="flex items-center justify-between pb-3 mb-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-100 text-teal-700 flex items-center justify-center text-lg">
                        <i class="fas fa-school"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-base">Foto Gedung Sekolah</h4>
                        <p class="text-xs text-gray-500">Tampil di Beranda (Profil) & Halaman Profil</p>
                    </div>
                </div>
                @php
                    $schoolVal = $settings['school_image'] ?? null;
                    $isSchoolCustom = $schoolVal && Storage::disk('public')->exists($schoolVal);
                    $schoolPreview = $isSchoolCustom ? Storage::url($schoolVal) : (file_exists(public_path('img/sekolah.jpg')) ? asset('img/sekolah.jpg') : asset('images/logo-nu.png'));
                @endphp
                @if($isSchoolCustom)
                    <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-teal-100 text-teal-800">Foto Kustom</span>
                @else
                    <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-gray-100 text-gray-600">Default Sistem</span>
                @endif
            </div>

            <div class="flex flex-col sm:flex-row gap-5 items-start">
                <div class="flex flex-col items-center gap-2 flex-shrink-0 w-full sm:w-auto">
                    <img id="preview_school" src="{{ $schoolPreview }}" alt="Gedung Sekolah" class="w-full sm:w-44 h-32 object-cover rounded-xl border-2 border-gray-200 shadow-sm bg-gray-50">
                    @if($isSchoolCustom)
                        <form action="{{ route('admin.setting.photo.reset', 'school_image') }}" method="POST" onsubmit="return confirm('Kembalikan foto gedung ke default bawaan sistem?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-rose-600 hover:text-rose-800 font-semibold hover:underline flex items-center gap-1 mt-1">
                                <i class="fas fa-undo"></i> Kembalikan Default
                            </button>
                        </form>
                    @endif
                </div>

                <div class="flex-1 w-full">
                    <form action="{{ route('admin.setting.photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="key" value="school_image">
                        <label class="form-label">Unggah Foto Baru</label>
                        <div class="upload-zone" onclick="document.getElementById('input_school').click()">
                            <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-1"></i>
                            <p class="text-xs text-gray-600 font-semibold">Klik untuk pilih foto</p>
                            <p class="text-[10px] text-gray-400 mt-0.5">JPG, PNG, WebP (Maks: 3MB)</p>
                            <input type="file" id="input_school" name="photo" accept="image/*" class="hidden" onchange="previewImg(this, 'preview_school', 'file_school')">
                            <div id="file_school" class="hidden mt-2 px-2.5 py-1 bg-green-50 border border-green-200 rounded text-[11px] text-green-700 font-medium"></div>
                        </div>
                        <div class="mt-3 flex justify-end">
                            <button type="submit" class="btn-save text-xs py-2 px-4">
                                <i class="fas fa-save"></i> Simpan Foto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Card 3: Foto Kepala Sekolah --}}
        <div class="setting-card mb-0">
            <div class="flex items-center justify-between pb-3 mb-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-lg">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-base">Foto Kepala Sekolah</h4>
                        <p class="text-xs text-gray-500">Tampil di Halaman Profil Sekolah</p>
                    </div>
                </div>
                @php
                    $ksVal = $settings['kepala_sekolah_photo'] ?? null;
                    $isKsCustom = $ksVal && Storage::disk('public')->exists($ksVal);
                    $ksPreview = $isKsCustom ? Storage::url($ksVal) : null;
                @endphp
                @if($isKsCustom)
                    <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-blue-100 text-blue-800">Foto Kustom</span>
                @else
                    <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-gray-100 text-gray-600">Belum Ada</span>
                @endif
            </div>

            <div class="flex flex-col sm:flex-row gap-5 items-start">
                <div class="flex flex-col items-center gap-2 flex-shrink-0 w-full sm:w-auto">
                    @if($ksPreview)
                        <img id="preview_ks" src="{{ $ksPreview }}" alt="Kepala Sekolah" class="w-24 h-24 sm:w-28 sm:h-28 object-cover rounded-full border-2 border-emerald-500 shadow-sm bg-gray-50">
                    @else
                        <div id="preview_ks_placeholder" class="w-24 h-24 sm:w-28 sm:h-28 rounded-full border-2 border-dashed border-gray-300 flex items-center justify-center bg-gray-50 text-gray-400">
                            <i class="fas fa-user-tie text-3xl"></i>
                        </div>
                        <img id="preview_ks" src="" alt="Kepala Sekolah" class="hidden w-24 h-24 sm:w-28 sm:h-28 object-cover rounded-full border-2 border-emerald-500 shadow-sm bg-gray-50">
                    @endif
                    @if($isKsCustom)
                        <form action="{{ route('admin.setting.photo.reset', 'kepala_sekolah_photo') }}" method="POST" onsubmit="return confirm('Hapus foto kepala sekolah?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-rose-600 hover:text-rose-800 font-semibold hover:underline flex items-center gap-1 mt-1">
                                <i class="fas fa-trash-alt"></i> Hapus Foto
                            </button>
                        </form>
                    @endif
                </div>

                <div class="flex-1 w-full">
                    <form action="{{ route('admin.setting.photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="key" value="kepala_sekolah_photo">
                        <label class="form-label">Unggah Foto Kepala Sekolah</label>
                        <div class="upload-zone" onclick="document.getElementById('input_ks').click()">
                            <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-1"></i>
                            <p class="text-xs text-gray-600 font-semibold">Klik untuk pilih foto</p>
                            <p class="text-[10px] text-gray-400 mt-0.5">JPG, PNG (Format Pas Foto/Persegi)</p>
                            <input type="file" id="input_ks" name="photo" accept="image/*" class="hidden" onchange="previewImg(this, 'preview_ks', 'file_ks', 'preview_ks_placeholder')">
                            <div id="file_ks" class="hidden mt-2 px-2.5 py-1 bg-green-50 border border-green-200 rounded text-[11px] text-green-700 font-medium"></div>
                        </div>
                        <div class="mt-3 flex justify-end">
                            <button type="submit" class="btn-save text-xs py-2 px-4">
                                <i class="fas fa-save"></i> Simpan Foto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Card 4: Logo LP Ma'arif NU / Yayasan --}}
        <div class="setting-card mb-0">
            <div class="flex items-center justify-between pb-3 mb-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-lg">
                        <i class="fas fa-award"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-base">Logo Yayasan LP Ma'arif NU</h4>
                        <p class="text-xs text-gray-500">Tampil di Halaman Profil Sekolah</p>
                    </div>
                </div>
                @php
                    $maarifVal = $settings['logo_maarif'] ?? null;
                    $isMaarifCustom = $maarifVal && Storage::disk('public')->exists($maarifVal);
                    $maarifPreview = $isMaarifCustom ? Storage::url($maarifVal) : (file_exists(public_path('img/logo-maarif.jpg')) ? asset('img/logo-maarif.jpg') : asset('images/logo-nu.png'));
                @endphp
                @if($isMaarifCustom)
                    <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-amber-100 text-amber-800">Logo Kustom</span>
                @else
                    <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-gray-100 text-gray-600">Default Sistem</span>
                @endif
            </div>

            <div class="flex flex-col sm:flex-row gap-5 items-start">
                <div class="flex flex-col items-center gap-2 flex-shrink-0 w-full sm:w-auto">
                    <img id="preview_maarif" src="{{ $maarifPreview }}" alt="Logo LP Ma'arif" class="w-24 h-24 object-contain rounded-xl border-2 border-gray-200 shadow-sm bg-white p-2">
                    @if($isMaarifCustom)
                        <form action="{{ route('admin.setting.photo.reset', 'logo_maarif') }}" method="POST" onsubmit="return confirm('Kembalikan logo yayasan ke default bawaan sistem?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-rose-600 hover:text-rose-800 font-semibold hover:underline flex items-center gap-1 mt-1">
                                <i class="fas fa-undo"></i> Kembalikan Default
                            </button>
                        </form>
                    @endif
                </div>

                <div class="flex-1 w-full">
                    <form action="{{ route('admin.setting.photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="key" value="logo_maarif">
                        <label class="form-label">Unggah Logo Yayasan Baru</label>
                        <div class="upload-zone" onclick="document.getElementById('input_maarif').click()">
                            <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-1"></i>
                            <p class="text-xs text-gray-600 font-semibold">Klik untuk pilih logo</p>
                            <p class="text-[10px] text-gray-400 mt-0.5">JPG, PNG, WebP (Maks: 2MB)</p>
                            <input type="file" id="input_maarif" name="photo" accept="image/*" class="hidden" onchange="previewImg(this, 'preview_maarif', 'file_maarif')">
                            <div id="file_maarif" class="hidden mt-2 px-2.5 py-1 bg-green-50 border border-green-200 rounded text-[11px] text-green-700 font-medium"></div>
                        </div>
                        <div class="mt-3 flex justify-end">
                            <button type="submit" class="btn-save text-xs py-2 px-4">
                                <i class="fas fa-save"></i> Simpan Logo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===================== TAB 2: LOGO SEKOLAH ===================== --}}
<div id="tab-logo" class="tab-content hidden">
    <div class="setting-card">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-lg">
                <i class="fas fa-certificate"></i>
            </div>
            <div>
                <h3 class="font-bold text-gray-900">Ganti Logo Resmi Sekolah</h3>
                <p class="text-xs text-gray-500">Logo digunakan di Navbar, Footer, Dashboard Admin & Guru, Halaman Login, dan Kop Surat Cetak</p>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-8 items-start">
            {{-- Preview --}}
            <div class="flex flex-col items-center gap-3 flex-shrink-0">
                <p class="form-label text-center">Logo Saat Ini</p>
                <img id="logoPreviewImg"
                    src="{{ (!empty($settings['logo_path'])) ? Storage::url($settings['logo_path']) : asset('images/logo-nu.png') }}"
                    alt="Logo Sekolah" class="logo-preview">
                <span class="text-xs text-gray-400">Format: JPG, PNG, WebP</span>
                @if(!empty($settings['logo_path']))
                    <form action="{{ route('admin.setting.photo.reset', 'logo_path') }}" method="POST" onsubmit="return confirm('Kembalikan logo sekolah ke logo default?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-rose-600 hover:text-rose-800 font-semibold hover:underline flex items-center gap-1 mt-1">
                            <i class="fas fa-undo"></i> Kembalikan Default
                        </button>
                    </form>
                @endif
            </div>

            {{-- Upload Form --}}
            <div class="flex-1">
                <form action="{{ route('admin.setting.logo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label class="form-label">Upload Logo Baru</label>
                    <div class="upload-zone" id="uploadZone" onclick="document.getElementById('logoInput').click()">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-600 font-medium">Klik atau drag & drop file logo</p>
                        <p class="text-xs text-gray-400 mt-1">Ukuran maks: 2MB | PNG/JPG/WebP (transparan direkomendasikan)</p>
                        <input type="file" id="logoInput" name="logo" accept="image/*" class="hidden" onchange="previewLogo(this)">
                        <div id="fileNameDisplay" class="hidden mt-3 px-3 py-1.5 bg-green-50 border border-green-200 rounded-lg text-xs text-green-700 font-semibold"></div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn-save">
                            <i class="fas fa-save"></i> Simpan Logo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ===================== TAB 2: PROFIL SEKOLAH ===================== --}}
<div id="tab-profil" class="tab-content hidden">
    <form action="{{ route('admin.setting.school') }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Identitas Sekolah --}}
        <div class="setting-card">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-green-100 text-green-700 flex items-center justify-center text-lg">
                    <i class="fas fa-school"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900">Identitas Sekolah</h3>
                    <p class="text-xs text-gray-500">Data utama yang ditampilkan di website dan dokumen</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Nama Sekolah *</label>
                    <input type="text" name="nama_sekolah" class="form-input"
                        value="{{ $settings['nama_sekolah'] ?? 'TK NU 04 AL-HIDAYAH SITUBONDO' }}" required>
                </div>
                <div>
                    <label class="form-label">Nama Yayasan</label>
                    <input type="text" name="nama_yayasan" class="form-input"
                        value="{{ $settings['nama_yayasan'] ?? 'YAYASAN LP MA\'ARIF NU CABANG SITUBONDO' }}">
                </div>
                <div>
                    <label class="form-label">Kepala Sekolah</label>
                    <input type="text" name="kepala_sekolah" class="form-input"
                        value="{{ $settings['kepala_sekolah'] ?? 'Ibu Siti Hanawiyun Nasyiin, S.Pd' }}">
                </div>
                <div>
                    <label class="form-label">Nomor Telepon / WhatsApp</label>
                    <input type="text" name="telepon" class="form-input"
                        value="{{ $settings['telepon'] ?? '085334766072' }}" placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label class="form-label">Email Resmi</label>
                    <input type="email" name="email" class="form-input"
                        value="{{ $settings['email'] ?? 'tknusitubondo04@gmail.com' }}">
                </div>
                <div>
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" class="form-input form-textarea">{{ $settings['alamat'] ?? '82H9+7FV, Jl. Raya Olean, Olean Tengah, Olean, Kec. Situbondo, Kabupaten Situbondo, Jawa Timur 68316' }}</textarea>
                </div>
            </div>
        </div>

        {{-- Visi Misi Tujuan --}}
        <div class="setting-card">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-lg">
                    <i class="fas fa-bullseye"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900">Visi, Misi & Tujuan</h3>
                    <p class="text-xs text-gray-500">Ditampilkan di halaman profil publik</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="form-label">Tujuan Sekolah</label>
                    <textarea name="tujuan" class="form-input form-textarea" style="min-height:100px;">{{ $settings['tujuan'] ?? 'Menjadi lembaga pendidikan anak usia dini yang mampu memberikan pendidikan yang berkualitas, membentuk anak yang beriman, berakhlak mulia, mandiri, kreatif, sehat, serta memiliki kemampuan sosial dan emosional yang baik.' }}</textarea>
                </div>
                <div>
                    <label class="form-label">Visi Sekolah</label>
                    <textarea name="visi" class="form-input form-textarea">{{ $settings['visi'] ?? 'Mencetak generasi yang cerdas, ceria, kreatif dan berakhlak mulia.' }}</textarea>
                </div>
                <div>
                    <label class="form-label">Misi Sekolah</label>
                    <textarea name="misi" class="form-input form-textarea" style="min-height:120px;">{{ $settings['misi'] ?? "- Cerdas dalam mengembangkan seluruh kemampuan perkembangan anak.\n- Menggali kreativitas anak melalui belajar yang menyenangkan.\n- Menanamkan sikap dan perilaku yang berakhlak mulia." }}</textarea>
                    <p class="text-xs text-gray-400 mt-1"><i class="fas fa-info-circle"></i> Pisahkan tiap misi dengan baris baru (gunakan tanda "-" di awal)</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn-save text-base px-6 py-3">
                <i class="fas fa-save"></i> Simpan Profil Sekolah
            </button>
        </div>
    </form>
</div>

{{-- ===================== TAB 3: DATA PENGAJAR ===================== --}}
<div id="tab-guru" class="tab-content hidden">
    <div class="setting-card">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
            <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center text-lg">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div>
                <h3 class="font-bold text-gray-900">Daftar Pengajar & Staf</h3>
                <p class="text-xs text-gray-500">Edit data guru, jabatan, nomor HP, dan foto</p>
            </div>
        </div>

        @if($gurus->isEmpty())
            <div class="text-center py-12 text-gray-400">
                <i class="fas fa-users text-4xl mb-3"></i>
                <p class="font-semibold">Belum ada data guru aktif.</p>
                <a href="{{ route('admin.guru.index') }}" class="text-green-600 text-sm font-bold hover:underline mt-2 inline-block">
                    + Tambah Guru Baru
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @foreach($gurus as $guru)
                <div class="guru-card">
                    {{-- Avatar --}}
                    <div class="flex-shrink-0">
                        @if($guru->foto)
                            <img src="{{ Storage::url($guru->foto) }}" alt="{{ $guru->nama }}"
                                class="w-14 h-14 rounded-full object-cover border-2 border-emerald-200 shadow">
                        @else
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-green-600 to-emerald-700 flex items-center justify-center text-white font-extrabold text-xl shadow">
                                {{ strtoupper(substr($guru->nama, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-gray-900 truncate">{{ $guru->nama }}</p>
                        <p class="text-xs text-gray-500">{{ $guru->jabatan }}</p>
                        @if($guru->no_hp)
                            <p class="text-xs text-emerald-700 font-semibold mt-0.5">
                                <i class="fas fa-phone-alt"></i> {{ $guru->no_hp }}
                            </p>
                        @else
                            <p class="text-xs text-gray-300 mt-0.5 italic">Belum ada nomor HP</p>
                        @endif
                    </div>
                    {{-- Edit Button --}}
                    <button type="button"
                        onclick="openGuruModal({{ $guru->id }}, '{{ addslashes($guru->nama) }}', '{{ addslashes($guru->nip) }}', '{{ addslashes($guru->jabatan) }}', '{{ addslashes($guru->no_hp) }}')"
                        class="flex-shrink-0 w-9 h-9 rounded-xl bg-amber-50 border border-amber-200 text-amber-700 hover:bg-amber-100 flex items-center justify-center transition-all hover:scale-105">
                        <i class="fas fa-edit text-sm"></i>
                    </button>
                </div>
                @endforeach
            </div>

            <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end">
                <a href="{{ route('admin.guru.index') }}"
                    class="inline-flex items-center gap-2 bg-green-50 border border-green-200 text-green-800 font-bold text-sm px-4 py-2 rounded-xl hover:bg-green-100 transition-all">
                    <i class="fas fa-user-plus"></i> Kelola Data Guru Lengkap
                </a>
            </div>
        @endif
    </div>
</div>

{{-- Modal Edit Guru --}}
<div id="guruModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-green-800 to-emerald-700 p-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                    <i class="fas fa-user-edit text-amber-300 text-lg"></i>
                </div>
                <div>
                    <h3 class="font-bold text-white">Edit Data Pengajar</h3>
                    <p class="text-xs text-green-300">Perbarui informasi guru</p>
                </div>
            </div>
            <button onclick="closeGuruModal()" class="text-green-300 hover:text-white transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <form id="guruEditForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" id="gEdit_nama" name="nama" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">NIP / NUPTK</label>
                    <input type="text" id="gEdit_nip" name="nip" class="form-input" placeholder="Opsional">
                </div>
                <div>
                    <label class="form-label">Jabatan *</label>
                    <input type="text" id="gEdit_jabatan" name="jabatan" class="form-input" required>
                </div>
                <div class="sm:col-span-2">
                    <label class="form-label">Nomor HP / WhatsApp</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">
                            <i class="fas fa-phone-alt"></i>
                        </span>
                        <input type="text" id="gEdit_no_hp" name="no_hp" class="form-input pl-9"
                            placeholder="Contoh: 08123456789">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label class="form-label">Ganti Foto (Opsional)</label>
                    <div class="upload-zone" onclick="document.getElementById('guruFotoInput').click()">
                        <i class="fas fa-camera text-2xl text-gray-400 mb-1"></i>
                        <p class="text-xs text-gray-500">Klik untuk upload foto guru (JPG/PNG, maks 2MB)</p>
                        <input type="file" id="guruFotoInput" name="foto" accept="image/*" class="hidden"
                            onchange="showFileName(this, 'guruFileName')">
                        <div id="guruFileName" class="hidden mt-2 text-xs text-green-700 font-semibold bg-green-50 px-3 py-1 rounded-lg border border-green-200"></div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
                <button type="button" onclick="closeGuruModal()"
                    class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 font-semibold text-sm hover:bg-gray-200 transition-all">
                    Batal
                </button>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// ---- Tab switching ----
const tabs = ['foto', 'profil', 'logo', 'guru'];
function showTab(id) {
    tabs.forEach(t => {
        const tabEl = document.getElementById('tab-' + t);
        const btnEl = document.getElementById('btn-' + t);
        if (tabEl) tabEl.classList.add('hidden');
        if (btnEl) btnEl.classList.remove('active');
    });
    const targetTab = document.getElementById(id);
    const targetBtn = document.getElementById('btn-' + id.replace('tab-', ''));
    if (targetTab) targetTab.classList.remove('hidden');
    if (targetBtn) targetBtn.classList.add('active');
}

// ---- Image preview generic with placeholder toggle ----
function previewImg(input, imgId, displayId, placeholderId = null) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById(imgId);
            if (img) {
                img.src = e.target.result;
                img.classList.remove('hidden');
            }
            if (placeholderId) {
                const ph = document.getElementById(placeholderId);
                if (ph) ph.classList.add('hidden');
            }
        };
        reader.readAsDataURL(input.files[0]);
        const disp = document.getElementById(displayId);
        if (disp) {
            disp.textContent = '✓ ' + input.files[0].name;
            disp.classList.remove('hidden');
        }
    }
}

// ---- Logo preview ----
function previewLogo(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('logoPreviewImg').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
        const disp = document.getElementById('fileNameDisplay');
        disp.textContent = '✓ ' + input.files[0].name;
        disp.classList.remove('hidden');
    }
}

// ---- Generic file name display ----
function showFileName(input, displayId) {
    if (input.files && input.files[0]) {
        const el = document.getElementById(displayId);
        el.textContent = '✓ ' + input.files[0].name;
        el.classList.remove('hidden');
    }
}

// ---- Guru modal ----
function openGuruModal(id, nama, nip, jabatan, no_hp) {
    document.getElementById('guruEditForm').action = '/admin/setting/guru/' + id;
    document.getElementById('gEdit_nama').value = nama;
    document.getElementById('gEdit_nip').value = nip && nip !== 'null' ? nip : '';
    document.getElementById('gEdit_jabatan').value = jabatan;
    document.getElementById('gEdit_no_hp').value = no_hp && no_hp !== 'null' ? no_hp : '';
    document.getElementById('guruFileName').classList.add('hidden');
    document.getElementById('guruModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}
function closeGuruModal() {
    document.getElementById('guruModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}
// Close on backdrop click
document.getElementById('guruModal').addEventListener('click', function(e) {
    if (e.target === this) closeGuruModal();
});

// Open tab from URL hash
if (window.location.hash === '#guru') showTab('tab-guru');
if (window.location.hash === '#profil') showTab('tab-profil');
if (window.location.hash === '#logo') showTab('tab-logo');
if (window.location.hash === '#foto') showTab('tab-foto');
</script>

@endsection
