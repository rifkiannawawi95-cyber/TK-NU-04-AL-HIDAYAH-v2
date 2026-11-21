@extends('layouts.admin')
@section('title', 'Manajemen Prestasi')
@section('header', 'Prestasi Santri & Siswa')

@section('content')
<div class="space-y-6">

    <!-- Form Tambah Prestasi Baru -->
    <div class="bg-white/90 backdrop-blur-md rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-800 text-xs font-bold mb-2">
                    <i class="fas fa-trophy text-amber-500"></i> Apresiasi & Kebanggaan
                </div>
                <h2 class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight">Catat Prestasi & Kejuaraan Siswa</h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Dokumentasikan piala dan piagam kejuaraan yang berhasil diraih santri cilik.</p>
            </div>
            <div class="px-4 py-2 bg-amber-50 text-amber-800 rounded-2xl border border-amber-200/80 font-bold text-xs flex items-center gap-2">
                <i class="fas fa-award text-amber-600"></i>
                <span>Total Prestasi: <strong>{{ $totalPrestasi ?? $prestasis->total() }}</strong></span>
            </div>
        </div>

        <form action="{{ route('admin.prestasi.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-start">
                
                <div class="md:col-span-6 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Nama Siswa <span class="text-rose-500">*</span></label>
                            <input type="text" name="nama_siswa" value="{{ old('nama_siswa') }}" placeholder="Contoh: Muhammad Al-Fatih" required
                                   class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Kelas <span class="text-rose-500">*</span></label>
                            <select name="kelas" required
                                    class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all">
                                <option value="A" {{ old('kelas') == 'A' ? 'selected' : '' }}>Kelas A</option>
                                <option value="B" {{ old('kelas') == 'B' ? 'selected' : '' }}>Kelas B</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Nama Lomba / Kejuaraan <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama_lomba" value="{{ old('nama_lomba') }}" placeholder="Contoh: Lomba Mewarnai Kaligrafi Islami" required
                               class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Juara Ke- <span class="text-rose-500">*</span></label>
                            <input type="text" name="juara" value="{{ old('juara') }}" placeholder="Contoh: Juara 1 / Harapan 1" required
                                   class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Tingkat</label>
                            <input type="text" name="tingkat" value="{{ old('tingkat', 'Kecamatan') }}" placeholder="Kecamatan / Kabupaten / Provinsi"
                                   class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-6 space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Tanggal Lomba <span class="text-rose-500">*</span></label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                               class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Keterangan Tambahan</label>
                        <input type="text" name="keterangan" value="{{ old('keterangan') }}" placeholder="Diselenggarakan oleh IGTKI Situbondo..."
                               class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Foto Pemenang / Sertifikat (Opsional)</label>
                        <input type="file" name="foto" accept="image/*"
                               class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100 transition-all">
                        <p class="text-[10px] text-slate-400 mt-1">Format: JPG, PNG, WEBP (Maksimal 5MB)</p>
                    </div>
                </div>

            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="reset" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-bold transition-all">
                    Reset
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white text-xs font-extrabold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                    <i class="fas fa-trophy"></i> Simpan Prestasi Siswa
                </button>
            </div>
        </form>
    </div>

    <!-- Table List Prestasi -->
    <div class="bg-white/90 backdrop-blur-md rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-extrabold text-slate-800">Daftar Kejuaraan & Prestasi Santri</h3>
                <p class="text-xs text-slate-400">Rekam jejak prestasi membanggakan siswa TK NU 04</p>
            </div>

            <form action="{{ route('admin.prestasi.index') }}" method="GET" class="flex items-center gap-2">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari santri atau lomba..."
                           class="pl-8 pr-4 py-2 text-xs rounded-xl bg-slate-50 border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 font-medium text-slate-800">
                </div>
                <button type="submit" class="px-3.5 py-2 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl transition-all">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.prestasi.index') }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition-all">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-[10px]">
                    <tr>
                        <th class="px-6 py-3.5">Foto Santri</th>
                        <th class="px-6 py-3.5">Nama & Kelas</th>
                        <th class="px-6 py-3.5">Juara & Nama Lomba</th>
                        <th class="px-6 py-3.5">Tingkat & Tanggal</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($prestasis as $prestasi)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-3.5">
                                <img src="{{ $prestasi->foto_url }}" 
                                     alt="{{ $prestasi->nama_siswa }}"
                                     class="w-12 h-12 rounded-2xl object-cover border border-amber-200 shadow-xs"
                                     onerror="this.onerror=null;this.src='{{ asset('images/default-prestasi.svg') }}';">
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap">
                                <div class="font-extrabold text-slate-800 text-sm">{{ $prestasi->nama_siswa }}</div>
                                <span class="inline-block mt-0.5 px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    Kelas {{ $prestasi->kelas }}
                                </span>
                            </td>
                            <td class="px-6 py-3.5">
                                <div class="font-black text-amber-700 text-sm flex items-center gap-1.5">
                                    <i class="fas fa-trophy text-amber-500"></i> {{ $prestasi->juara }}
                                </div>
                                <div class="font-bold text-slate-800 mt-0.5">{{ $prestasi->nama_lomba }}</div>
                                @if($prestasi->keterangan)
                                    <div class="text-[11px] text-slate-400 mt-0.5 line-clamp-1">{{ $prestasi->keterangan }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-3.5 whitespace-nowrap text-slate-600">
                                <div class="font-bold text-slate-700">{{ $prestasi->tingkat ? 'Tingkat ' . $prestasi->tingkat : 'Umum' }}</div>
                                <div class="text-[10px] text-slate-400 mt-0.5"><i class="far fa-calendar mr-1"></i> {{ \Carbon\Carbon::parse($prestasi->tanggal)->translatedFormat('d M Y') }}</div>
                            </td>
                            <td class="px-6 py-3.5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button type="button" 
                                            onclick="openEditPrestasi({{ $prestasi->id }}, '{{ addslashes($prestasi->nama_siswa) }}', '{{ $prestasi->kelas }}', '{{ addslashes($prestasi->nama_lomba) }}', '{{ addslashes($prestasi->juara) }}', '{{ addslashes($prestasi->tingkat ?? '') }}', '{{ $prestasi->tanggal }}', '{{ addslashes($prestasi->keterangan ?? '') }}')"
                                            class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-amber-50 hover:text-amber-700 text-slate-600 flex items-center justify-center transition-colors"
                                            title="Edit Prestasi">
                                        <i class="fas fa-pencil-alt text-xs"></i>
                                    </button>
                                    <form action="{{ route('admin.prestasi.destroy', $prestasi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data prestasi ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-rose-50 hover:text-rose-600 text-slate-600 flex items-center justify-center transition-colors"
                                                title="Hapus Prestasi">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <div class="w-14 h-14 mx-auto rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl mb-3">
                                    <i class="fas fa-award"></i>
                                </div>
                                <p class="font-bold text-slate-700 text-sm">Belum Ada Catatan Prestasi</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">Catat prestasi dan kejuaraan siswa melalui formulir di atas.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-slate-100">
            {{ $prestasis->links() }}
        </div>
    </div>

</div>

<!-- Modal Edit Prestasi -->
<div id="edit-prestasi-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="relative max-w-lg w-full bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden" onclick="event.stopPropagation()">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50">
            <h3 class="text-base font-bold text-slate-800">Edit Prestasi Siswa</h3>
            <button onclick="closeEditPrestasi()" class="w-8 h-8 rounded-full hover:bg-slate-200 text-slate-500 flex items-center justify-center transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="edit-prestasi-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-3 gap-3">
                <div class="col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Nama Siswa</label>
                    <input type="text" id="edit-nama-siswa" name="nama_siswa" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Kelas</label>
                    <select id="edit-kelas" name="kelas" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                        <option value="A">Kelas A</option>
                        <option value="B">Kelas B</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Nama Lomba</label>
                <input type="text" id="edit-nama-lomba" name="nama_lomba" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Juara</label>
                    <input type="text" id="edit-juara" name="juara" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Tingkat</label>
                    <input type="text" id="edit-tingkat" name="tingkat" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Tanggal</label>
                    <input type="date" id="edit-tanggal-prestasi" name="tanggal" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Keterangan</label>
                    <input type="text" id="edit-keterangan" name="keterangan" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-600 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Ganti Foto Pemenang (Opsional)</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100">
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeEditPrestasi()" class="px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl">Batal</button>
                <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-amber-500 hover:bg-amber-600 rounded-xl shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditPrestasi(id, nama, kelas, lomba, juara, tingkat, tanggal, keterangan) {
        document.getElementById('edit-prestasi-form').action = '/admin/prestasi/' + id;
        document.getElementById('edit-nama-siswa').value = nama;
        document.getElementById('edit-kelas').value = kelas;
        document.getElementById('edit-nama-lomba').value = lomba;
        document.getElementById('edit-juara').value = juara;
        document.getElementById('edit-tingkat').value = tingkat;
        document.getElementById('edit-tanggal-prestasi').value = tanggal;
        document.getElementById('edit-keterangan').value = keterangan;
        document.getElementById('edit-prestasi-modal').classList.remove('hidden');
    }

    function closeEditPrestasi() {
        document.getElementById('edit-prestasi-modal').classList.add('hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEditPrestasi();
        }
    });
</script>
@endsection
