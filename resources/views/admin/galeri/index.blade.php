@extends('layouts.admin')
@section('title', 'Manajemen Galeri Kegiatan')
@section('header', 'Galeri Kegiatan Sekolah')

@section('content')
<div class="space-y-6">

    <!-- Top Action & Upload Card (Glassmorphism Modern Style) -->
    <div class="bg-white/90 backdrop-blur-md rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80 transition-all">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-slate-100">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold mb-2">
                    <i class="fas fa-camera text-emerald-600"></i> Media & Dokumentasi Visual
                </div>
                <h2 class="text-2xl font-black text-slate-800 tracking-tight">Unggah Foto Galeri Baru</h2>
                <p class="text-sm text-slate-500 mt-0.5">Dokumentasikan momen kegiatan pembelajaran, lomba, dan kreativitas santri/siswa.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="px-4 py-2 bg-emerald-50 text-emerald-800 rounded-2xl border border-emerald-200/80 font-bold text-xs flex items-center gap-2">
                    <i class="fas fa-images text-emerald-600"></i>
                    <span>Total Koleksi: <strong>{{ $totalFoto ?? $galeris->total() }} Foto</strong></span>
                </div>
            </div>
        </div>

        <!-- Upload Form -->
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                
                <!-- Left Input Fields -->
                <div class="md:col-span-7 space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                            Judul Foto / Kegiatan <span class="text-slate-400 font-normal">(Opsional)</span>
                        </label>
                        <input type="text" 
                               name="judul" 
                               value="{{ old('judul') }}"
                               placeholder="Contoh: Manasik Haji Santri Cilik 2026"
                               class="w-full px-4 py-3 rounded-2xl bg-slate-50 border border-slate-200 text-slate-800 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600 transition-all font-medium">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                            Kategori Foto
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   id="kategori-input"
                                   name="kategori" 
                                   value="{{ old('kategori', 'Kegiatan') }}"
                                   placeholder="Pilih atau ketik kategori..."
                                   class="w-full px-4 py-3 rounded-2xl bg-slate-50 border border-slate-200 text-slate-800 text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600 transition-all font-medium">
                        </div>
                        
                        <!-- Quick Category Pills -->
                        <div class="flex flex-wrap items-center gap-2 mt-2">
                            <span class="text-[11px] font-semibold text-slate-400">Pilih Cepat:</span>
                            @foreach(['Kegiatan', 'Pembelajaran', 'Lomba', 'Keagamaan', 'Outing Class', 'Pentas Seni'] as $tag)
                                <button type="button" 
                                        onclick="document.getElementById('kategori-input').value = '{{ $tag }}'"
                                        class="px-2.5 py-1 text-xs rounded-lg bg-slate-100 hover:bg-emerald-100 hover:text-emerald-800 text-slate-600 font-semibold transition-colors">
                                    {{ $tag }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right File Drag & Drop / Selector -->
                <div class="md:col-span-5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                        Pilih File Gambar <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative border-2 border-dashed border-emerald-300 hover:border-emerald-500 bg-emerald-50/40 hover:bg-emerald-50/70 rounded-2xl p-5 text-center transition-all cursor-pointer group"
                         onclick="document.getElementById('foto-file-input').click()">
                        
                        <input type="file" 
                               id="foto-file-input"
                               name="foto" 
                               accept="image/jpeg,image/png,image/jpg,image/webp,image/gif"
                               class="hidden"
                               required
                               onchange="previewImage(event)">

                        <div id="preview-placeholder" class="space-y-2 py-3">
                            <div class="w-14 h-14 mx-auto rounded-2xl bg-white text-emerald-600 shadow-sm border border-emerald-100 flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <p class="text-xs font-bold text-slate-700">Klik untuk jelajahi file gambar</p>
                            <p class="text-[11px] text-slate-400 font-medium">JPG, PNG, WEBP, GIF (Maks. 5 MB)</p>
                        </div>

                        <!-- Live Preview Container -->
                        <div id="preview-container" class="hidden relative">
                            <img id="image-preview" src="#" alt="Preview Foto" class="w-full h-36 object-cover rounded-xl shadow-sm border border-emerald-200">
                            <div class="absolute inset-0 bg-black/40 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-xs font-bold">
                                <i class="fas fa-sync-alt mr-1"></i> Klik untuk Ganti Gambar
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Submit Button Bar -->
            <div class="flex items-center justify-end gap-3 mt-6 pt-5 border-t border-slate-100">
                <button type="reset" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-bold transition-all">
                    Reset
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-700 hover:to-teal-800 text-white text-xs font-extrabold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                    <i class="fas fa-upload"></i> Unggah Foto ke Galeri
                </button>
            </div>
        </form>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white/90 backdrop-blur-md rounded-2xl p-4 shadow-sm border border-slate-200/80 flex flex-col md:flex-row md:items-center justify-between gap-4">
        
        <!-- Search Input -->
        <form action="{{ route('admin.galeri.index') }}" method="GET" class="flex-1 flex items-center gap-2">
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari judul atau kategori foto..." 
                       class="w-full pl-10 pr-4 py-2.5 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 font-medium text-slate-800">
            </div>
            @if(request('kategori'))
                <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            @endif
            <button type="submit" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl transition-all">
                Cari
            </button>
            @if(request('search') || request('kategori'))
                <a href="{{ route('admin.galeri.index') }}" class="px-3 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition-all" title="Reset Filter">
                    <i class="fas fa-redo-alt"></i>
                </a>
            @endif
        </form>

        <!-- Category Filters -->
        <div class="flex items-center gap-1.5 overflow-x-auto pb-1 md:pb-0 text-xs font-bold">
            <a href="{{ route('admin.galeri.index', array_merge(request()->except('kategori', 'page'), ['kategori' => ''])) }}" 
               class="px-3 py-1.5 rounded-xl transition-all whitespace-nowrap {{ !request('kategori') ? 'bg-emerald-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                Semua Foto
            </a>
            @foreach($daftarKategori as $kat)
                <a href="{{ route('admin.galeri.index', array_merge(request()->except('page'), ['kategori' => $kat])) }}" 
                   class="px-3 py-1.5 rounded-xl transition-all whitespace-nowrap {{ request('kategori') === $kat ? 'bg-emerald-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    {{ $kat }}
                </a>
            @endforeach
        </div>

    </div>

    <!-- Gallery Grid Cards with Modern Clean Glassmorphism & Hover Zoom -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        @forelse($galeris as $galeri)
            @php
                // Sanitasi dan resolusi URL gambar foto dengan fallback terpercaya
                $fotoSrc = asset('images/default-galeri.svg');
                $rawFoto = $galeri->foto ? ltrim(trim($galeri->foto), '/\\') : null;

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

            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl border border-slate-200/80 transition-all duration-300 flex flex-col group relative">
                
                <!-- Image Wrapper with Hover Zoom -->
                <div class="relative w-full h-48 bg-slate-100 overflow-hidden cursor-pointer" 
                     onclick="openLightbox('{{ $fotoSrc }}', '{{ addslashes($galeri->judul ?? 'Foto Kegiatan') }}', '{{ addslashes($galeri->kategori ?? 'Kegiatan') }}')">
                    
                    <img src="{{ $fotoSrc }}" 
                         alt="{{ $galeri->judul ?? 'Foto Kegiatan' }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
                         loading="lazy"
                         onerror="this.onerror=null;this.src='{{ asset('images/default-galeri.svg') }}';">

                    <!-- Gradient Vignette on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3">
                        <span class="text-white text-xs font-bold inline-flex items-center gap-1">
                            <i class="fas fa-search-plus"></i> Klik untuk perbesar
                        </span>
                    </div>

                    <!-- Category Chip Floating Badge -->
                    <div class="absolute top-3 left-3">
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-white/95 backdrop-blur-md text-emerald-800 shadow-sm border border-emerald-100">
                            {{ $galeri->kategori ?: 'Kegiatan' }}
                        </span>
                    </div>

                    <!-- Quick Delete / Edit Action Bar Overlay -->
                    <div class="absolute top-3 right-3 flex items-center gap-1.5 opacity-90 sm:opacity-0 group-hover:opacity-100 transition-all duration-200">
                        <button type="button" 
                                onclick="event.stopPropagation(); openEditModal({{ $galeri->id }}, '{{ addslashes($galeri->judul ?? '') }}', '{{ addslashes($galeri->kategori ?? '') }}')"
                                class="w-8 h-8 rounded-full bg-white/95 text-slate-700 hover:text-emerald-700 hover:bg-emerald-50 shadow-md flex items-center justify-center text-xs transition-colors"
                                title="Edit Judul & Kategori">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini? File akan dihapus permanen.');" onclick="event.stopPropagation();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-8 h-8 rounded-full bg-white/95 text-rose-600 hover:text-white hover:bg-rose-600 shadow-md flex items-center justify-center text-xs transition-colors"
                                    title="Hapus Foto">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>

                </div>

                <!-- Card Details -->
                <div class="p-4 flex-1 flex flex-col justify-between bg-white">
                    <div>
                        <h3 class="text-sm font-bold text-slate-800 line-clamp-1 group-hover:text-emerald-700 transition-colors" title="{{ $galeri->judul }}">
                            {{ $galeri->judul ?: 'Tanpa Judul' }}
                        </h3>
                        <p class="text-[11px] text-slate-400 font-medium mt-1 flex items-center gap-1.5">
                            <i class="far fa-clock"></i> {{ $galeri->created_at ? $galeri->created_at->diffForHumans() : 'Baru saja' }}
                        </p>
                    </div>

                    <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-[11px] text-slate-500 font-medium truncate max-w-[150px]">
                            <i class="fas fa-folder text-emerald-500 mr-1"></i> {{ $galeri->kategori ?: 'Kegiatan' }}
                        </span>
                        <button type="button"
                                onclick="openLightbox('{{ $fotoSrc }}', '{{ addslashes($galeri->judul ?? 'Foto Kegiatan') }}', '{{ addslashes($galeri->kategori ?? 'Kegiatan') }}')"
                                class="text-emerald-600 hover:text-emerald-800 font-bold text-xs inline-flex items-center gap-1">
                            Lihat <i class="fas fa-chevron-right text-[10px]"></i>
                        </button>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-full py-16 px-4 text-center bg-white rounded-3xl border border-slate-200/80 shadow-sm">
                <div class="w-20 h-20 mx-auto rounded-3xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-3xl mb-4 shadow-inner border border-emerald-100">
                    <i class="fas fa-camera-retro"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Belum Ada Foto Galeri</h3>
                <p class="text-xs text-slate-500 max-w-md mx-auto mt-1 mb-6">
                    @if(request('search') || request('kategori'))
                        Tidak ditemukan foto yang sesuai dengan filter pencarian Anda.
                    @else
                        Mulai abadikan momen kegiatan belajar anak dengan mengunggah foto melalui formulir di atas.
                    @endif
                </p>
                @if(request('search') || request('kategori'))
                    <a href="{{ route('admin.galeri.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-800 text-white text-xs font-bold hover:bg-slate-900 transition-all">
                        Reset Filter
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $galeris->links() }}
    </div>

</div>

<!-- Modal Lightbox Preview Foto -->
<div id="lightbox-modal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden flex items-center justify-center p-4" onclick="closeLightbox()">
    <div class="relative max-w-4xl w-full bg-slate-900 rounded-3xl overflow-hidden shadow-2xl border border-white/10" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between p-4 bg-slate-950/80 border-b border-white/10 text-white">
            <div>
                <span id="modal-category" class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-emerald-600 text-white mr-2"></span>
                <span id="modal-title" class="text-sm font-bold"></span>
            </div>
            <button onclick="closeLightbox()" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-2 sm:p-4 flex items-center justify-center bg-black/50 max-h-[75vh]">
            <img id="lightbox-image" src="#" alt="Preview" class="max-h-[70vh] w-auto max-w-full rounded-2xl object-contain shadow-2xl">
        </div>
        <div class="p-3 bg-slate-950/80 text-center text-xs text-slate-400">
            TK NU 04 AL-HIDAYAH SITUBONDO &bull; Dokumentasi Resmi
        </div>
    </div>
</div>

<!-- Modal Edit Foto Galeri -->
<div id="edit-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="relative max-w-md w-full bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden" onclick="event.stopPropagation()">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50">
            <h3 class="text-base font-bold text-slate-800">Edit Foto Galeri</h3>
            <button onclick="closeEditModal()" class="w-8 h-8 rounded-full hover:bg-slate-200 text-slate-500 flex items-center justify-center transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="edit-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Judul Foto</label>
                <input type="text" id="edit-judul" name="judul" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Kategori</label>
                <input type="text" id="edit-kategori" name="kategori" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Ganti File Foto (Opsional)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl">Batal</button>
                <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Live Image Preview for Upload Form
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
                document.getElementById('preview-placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Lightbox modal handler
    function openLightbox(src, title, category) {
        document.getElementById('lightbox-image').src = src;
        document.getElementById('modal-title').textContent = title || 'Dokumentasi Foto';
        document.getElementById('modal-category').textContent = category || 'Kegiatan';
        document.getElementById('lightbox-modal').classList.remove('hidden');
    }

    function closeLightbox() {
        document.getElementById('lightbox-modal').classList.add('hidden');
    }

    // Edit modal handler
    function openEditModal(id, judul, kategori) {
        document.getElementById('edit-form').action = '/admin/galeri/' + id;
        document.getElementById('edit-judul').value = judul;
        document.getElementById('edit-kategori').value = kategori;
        document.getElementById('edit-modal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('edit-modal').classList.add('hidden');
    }

    // ESC key closes modals
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
            closeEditModal();
        }
    });
</script>
@endsection
