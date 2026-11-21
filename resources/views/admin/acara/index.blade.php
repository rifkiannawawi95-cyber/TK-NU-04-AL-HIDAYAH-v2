@extends('layouts.admin')
@section('title', 'Manajemen Acara')
@section('header', 'Agenda & Acara Sekolah')

@section('content')
<div class="space-y-6">

    <!-- Top Form Card: Tambah Acara Baru -->
    <div class="bg-white/90 backdrop-blur-md rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold mb-2">
                    <i class="fas fa-calendar-star text-emerald-600"></i> Publikasi Kegiatan
                </div>
                <h2 class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight">Tambah Acara & Kegiatan Baru</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Kelola informasi kegiatan mingguan, manasik, lomba, dan peringatan hari besar Islam.</p>
            </div>
            <div class="px-4 py-2 bg-emerald-50 text-emerald-800 rounded-2xl border border-emerald-200/80 font-bold text-xs flex items-center gap-2">
                <i class="fas fa-calendar-check text-emerald-600"></i>
                <span>Total Acara: <strong>{{ $totalAcara ?? $acaras->total() }}</strong></span>
            </div>
        </div>

        <form action="{{ route('admin.acara.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-start">
                
                <div class="md:col-span-6 space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Nama Acara <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Manasik Haji Santri Cilik 2026" required
                               class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Tanggal Pelaksanaan <span class="text-rose-500">*</span></label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                                   class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Kategori</label>
                            <input type="text" name="kategori" value="{{ old('kategori', 'Kegiatan') }}" placeholder="Misal: Keagamaan, Lomba"
                                   class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Lokasi Acara</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', 'Halaman Sekolah TK NU 04') }}" placeholder="Contoh: Halaman TK NU 04 Situbondo"
                               class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all">
                    </div>
                </div>

                <div class="md:col-span-6 space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Deskripsi Lengkap <span class="text-rose-500">*</span></label>
                        <textarea name="deskripsi" rows="3" placeholder="Jelaskan tujuan dan rangkaian acara secara singkat dan menarik..." required
                                  class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Foto Dokumentasi Acara</label>
                        <input type="file" name="foto" accept="image/*"
                               class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all">
                        <p class="text-[10px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (Maksimal 5MB)</p>
                    </div>
                </div>

            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="reset" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-bold transition-all">
                    Reset
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-700 hover:to-teal-800 text-white text-xs font-extrabold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                    <i class="fas fa-plus-circle"></i> Simpan Acara Baru
                </button>
            </div>
        </form>
    </div>

    <!-- Table List Card -->
    <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-extrabold text-slate-800">Daftar Acara & Kegiatan Terjadwal</h3>
                <p class="text-xs text-slate-400">Seluruh agenda kegiatan pembelajaran & perayaan sekolah</p>
            </div>
            
            <form action="{{ route('admin.acara.index') }}" method="GET" class="flex items-center gap-2">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau kategori..."
                           class="pl-8 pr-4 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 font-medium text-slate-800">
                </div>
                <button type="submit" class="px-3.5 py-2 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl transition-all">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.acara.index') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition-all">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-[10px]">
                    <tr>
                        <th class="px-6 py-3.5">Foto</th>
                        <th class="px-6 py-3.5">Tanggal</th>
                        <th class="px-6 py-3.5">Nama Acara & Kategori</th>
                        <th class="px-6 py-3.5">Deskripsi</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($acaras as $acara)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-3.5">
                                <img src="{{ $acara->foto_url }}" 
                                     alt="{{ $acara->nama }}"
                                     class="w-14 h-14 rounded-2xl object-cover border border-slate-200 shadow-xs"
                                     onerror="this.onerror=null;this.src='{{ asset('images/default-acara.svg') }}';">
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap font-bold text-slate-700">
                                <span class="block text-emerald-700"><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($acara->tanggal)->translatedFormat('d M Y') }}</span>
                                <span class="block text-[10px] text-slate-400 font-medium">{{ \Carbon\Carbon::parse($acara->tanggal)->diffForHumans() }}</span>
                            </td>
                            <td class="px-6 py-3.5">
                                <div class="font-bold text-slate-800 text-sm leading-snug">{{ $acara->nama }}</div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold uppercase tracking-wider bg-emerald-50 text-emerald-800 border border-emerald-200">
                                        {{ $acara->kategori ?: 'Kegiatan' }}
                                    </span>
                                    @if($acara->lokasi)
                                        <span class="text-[10px] text-slate-400 font-medium flex items-center gap-1">
                                            <i class="fas fa-map-marker-alt text-rose-500"></i> {{ $acara->lokasi }}
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-3.5 text-slate-500 max-w-xs">
                                <p class="line-clamp-2 leading-relaxed">{{ $acara->deskripsi }}</p>
                            </td>
                            <td class="px-6 py-3.5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" 
                                            onclick="openEditAcara({{ $acara->id }}, '{{ addslashes($acara->nama) }}', '{{ $acara->tanggal }}', '{{ addslashes($acara->deskripsi) }}', '{{ addslashes($acara->kategori ?? '') }}', '{{ addslashes($acara->lokasi ?? '') }}')"
                                            class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-emerald-50 hover:text-emerald-700 text-slate-600 flex items-center justify-center transition-colors"
                                            title="Edit Acara">
                                        <i class="fas fa-pencil-alt text-xs"></i>
                                    </button>
                                    <form action="{{ route('admin.acara.destroy', $acara->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus acara ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-rose-50 hover:text-rose-600 text-slate-600 flex items-center justify-center transition-colors"
                                                title="Hapus Acara">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <div class="w-14 h-14 mx-auto rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mb-3">
                                    <i class="fas fa-calendar-times"></i>
                                </div>
                                <p class="font-bold text-slate-700 text-sm">Belum Ada Acara</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Mulai publikasikan acara melalui formulir di atas.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-100">
            {{ $acaras->links() }}
        </div>
    </div>

</div>

<!-- Modal Edit Acara -->
<div id="edit-acara-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="relative max-w-lg w-full bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden" onclick="event.stopPropagation()">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50">
            <h3 class="text-base font-bold text-slate-800">Edit Data Acara</h3>
            <button onclick="closeEditAcara()" class="w-8 h-8 rounded-full hover:bg-slate-200 text-slate-500 flex items-center justify-center transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="edit-acara-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Nama Acara</label>
                <input type="text" id="edit-nama" name="nama" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Tanggal</label>
                    <input type="date" id="edit-tanggal" name="tanggal" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Kategori</label>
                    <input type="text" id="edit-kategori" name="kategori" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Lokasi</label>
                <input type="text" id="edit-lokasi" name="lokasi" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Deskripsi</label>
                <textarea id="edit-deskripsi" name="deskripsi" rows="3" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Ganti Foto (Opsional)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeEditAcara()" class="px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl">Batal</button>
                <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditAcara(id, nama, tanggal, deskripsi, kategori, lokasi) {
        document.getElementById('edit-acara-form').action = '/admin/acara/' + id;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-tanggal').value = tanggal;
        document.getElementById('edit-deskripsi').value = deskripsi;
        document.getElementById('edit-kategori').value = kategori;
        document.getElementById('edit-lokasi').value = lokasi;
        document.getElementById('edit-acara-modal').classList.remove('hidden');
    }

    function closeEditAcara() {
        document.getElementById('edit-acara-modal').classList.add('hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEditAcara();
        }
    });
</script>
@endsection
