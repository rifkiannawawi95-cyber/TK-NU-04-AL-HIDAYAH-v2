@extends('layouts.admin')
@section('title', 'Kalender Akademik')
@section('header', 'Kalender & Agenda Akademik')

@section('content')
<div class="space-y-6">

    <!-- Top Form Card: Tambah Agenda Minimalis -->
    <div class="bg-white/90 backdrop-blur-md rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-200/80">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-5 border-b border-slate-100">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-violet-50 border border-violet-200 text-violet-800 text-xs font-bold mb-1.5">
                    <i class="fas fa-calendar-days text-violet-600"></i> Kalender Minimalis
                </div>
                <h2 class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight">Tambah Agenda Sekolah</h2>
                <p class="text-xs text-slate-500">Jadwalkan hari efektif, masa evaluasi, dan hari libur sekolah.</p>
            </div>
            <div class="px-4 py-2 bg-violet-50 text-violet-800 rounded-2xl border border-violet-200/80 font-bold text-xs flex items-center gap-2">
                <i class="fas fa-list-check text-violet-600"></i>
                <span>Total Agenda: <strong>{{ $kalenders->total() }}</strong></span>
            </div>
        </div>

        <form action="{{ route('admin.kalender.store') }}" method="POST" class="mt-5 space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                <div class="md:col-span-6">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Nama Kegiatan / Agenda <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama_kegiatan" required placeholder="Contoh: Pembagian Raport Semester Ganjil"
                           class="w-full px-4 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-600 transition-all">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Tanggal Mulai <span class="text-rose-500">*</span></label>
                    <input type="date" name="tanggal_mulai" required value="{{ date('Y-m-d') }}"
                           class="w-full px-3 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-600 transition-all">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Selesai (Opsional)</label>
                    <input type="date" name="tanggal_selesai"
                           class="w-full px-3 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-medium focus:bg-white focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-600 transition-all">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Kategori</label>
                    <select name="jenis" class="w-full px-3 py-2.5 rounded-2xl bg-slate-50 border border-slate-200 text-xs font-bold focus:bg-white focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-600 transition-all">
                        <option value="Kegiatan">Kegiatan</option>
                        <option value="Libur">Hari Libur</option>
                        <option value="Ujian">Evaluasi / Ujian</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-violet-600 to-indigo-700 hover:from-violet-700 hover:to-indigo-800 text-white text-xs font-extrabold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                    <i class="fas fa-plus"></i> Simpan Agenda
                </button>
            </div>
        </form>
    </div>

    <!-- Super Minimalist Agenda List (Compact Card List) -->
    <div class="bg-white/90 backdrop-blur-md rounded-3xl p-6 sm:p-7 shadow-sm border border-slate-200/80">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div>
                <h3 class="text-base font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                    <i class="fas fa-timeline text-violet-600"></i> Timeline Agenda Akademik
                </h3>
                <p class="text-xs text-slate-400">Daftar agenda bulanan dalam format kartu ringkas</p>
            </div>
        </div>

        <!-- Agenda Card List -->
        <div class="space-y-3">
            @forelse($kalenders as $kalender)
                @php
                    $isLibur = strtolower($kalender->jenis) == 'libur';
                    $isUjian = strtolower($kalender->jenis) == 'ujian';
                    $badgeBg = $isLibur ? 'bg-rose-50 text-rose-700 border-rose-200' : ($isUjian ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-emerald-50 text-emerald-800 border-emerald-200');
                    $dateBg = $isLibur ? 'bg-rose-600 text-white' : ($isUjian ? 'bg-amber-500 text-white' : 'bg-emerald-600 text-white');
                @endphp

                <div class="p-4 rounded-2xl bg-slate-50/70 hover:bg-white border border-slate-200/70 hover:border-slate-300 shadow-xs hover:shadow-md transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-4 group">
                    
                    <div class="flex items-start sm:items-center gap-3.5 flex-1 min-w-0">
                        <!-- Compact Date Badge -->
                        <div class="w-12 h-12 rounded-2xl {{ $dateBg }} flex flex-col items-center justify-center flex-shrink-0 font-black shadow-xs leading-none">
                            <span class="text-sm">{{ \Carbon\Carbon::parse($kalender->tanggal_mulai)->format('d') }}</span>
                            <span class="text-[9px] font-bold uppercase mt-0.5 opacity-90">{{ \Carbon\Carbon::parse($kalender->tanggal_mulai)->format('M') }}</span>
                        </div>

                        <!-- Content Details -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h4 class="text-sm font-extrabold text-slate-800 leading-snug group-hover:text-emerald-700 transition-colors">
                                    {{ $kalender->nama_kegiatan }}
                                </h4>
                                <span class="px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider border {{ $badgeBg }}">
                                    {{ $kalender->jenis }}
                                </span>
                            </div>

                            <div class="flex items-center gap-3 mt-1 text-[11px] text-slate-500 font-medium flex-wrap">
                                <span class="flex items-center gap-1">
                                    <i class="far fa-clock text-slate-400"></i>
                                    {{ \Carbon\Carbon::parse($kalender->tanggal_mulai)->translatedFormat('d F Y') }}
                                    @if($kalender->tanggal_selesai && $kalender->tanggal_mulai != $kalender->tanggal_selesai)
                                        s/d {{ \Carbon\Carbon::parse($kalender->tanggal_selesai)->translatedFormat('d F Y') }}
                                    @endif
                                </span>
                                <span class="text-slate-300">&bull;</span>
                                <span class="flex items-center gap-1">
                                    <i class="fas fa-location-dot text-rose-500 text-[10px]"></i> TK NU 04 Situbondo
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-1.5 self-end sm:self-center border-t sm:border-t-0 pt-2 sm:pt-0 border-slate-100">
                        <button type="button" 
                                onclick="openEditKalender({{ $kalender->id }}, '{{ addslashes($kalender->nama_kegiatan) }}', '{{ $kalender->tanggal_mulai }}', '{{ $kalender->tanggal_selesai ?? '' }}', '{{ $kalender->jenis }}')"
                                class="w-8 h-8 rounded-xl bg-white hover:bg-violet-50 hover:text-violet-700 text-slate-500 shadow-xs border border-slate-200 flex items-center justify-center transition-colors"
                                title="Edit Agenda">
                            <i class="fas fa-pencil-alt text-xs"></i>
                        </button>
                        <form action="{{ route('admin.kalender.destroy', $kalender->id) }}" method="POST" onsubmit="return confirm('Hapus agenda ini?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-8 h-8 rounded-xl bg-white hover:bg-rose-50 hover:text-rose-600 text-slate-500 shadow-xs border border-slate-200 flex items-center justify-center transition-colors"
                                    title="Hapus Agenda">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="text-center py-12 text-slate-400">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-violet-50 text-violet-600 flex items-center justify-center text-xl mb-2">
                        <i class="fas fa-calendar-xmark"></i>
                    </div>
                    <p class="font-bold text-slate-700 text-xs">Belum ada agenda kalender akademik.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6 pt-4 border-t border-slate-100">
            {{ $kalenders->links() }}
        </div>
    </div>

</div>

<!-- Modal Edit Kalender -->
<div id="edit-kalender-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
    <div class="relative max-w-md w-full bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden" onclick="event.stopPropagation()">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50">
            <h3 class="text-base font-bold text-slate-800">Edit Agenda Kalender</h3>
            <button onclick="closeEditKalender()" class="w-8 h-8 rounded-full hover:bg-slate-200 text-slate-500 flex items-center justify-center transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="edit-kalender-form" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Nama Kegiatan</label>
                <input type="text" id="edit-nama-kegiatan" name="nama_kegiatan" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-violet-500/20 focus:border-violet-600 outline-none">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Mulai</label>
                    <input type="date" id="edit-tanggal-mulai" name="tanggal_mulai" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-violet-500/20 focus:border-violet-600 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Selesai</label>
                    <input type="date" id="edit-tanggal-selesai" name="tanggal_selesai" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-violet-500/20 focus:border-violet-600 outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">Jenis</label>
                <select id="edit-jenis" name="jenis" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-medium focus:ring-2 focus:ring-violet-500/20 focus:border-violet-600 outline-none">
                    <option value="Kegiatan">Kegiatan</option>
                    <option value="Libur">Hari Libur</option>
                    <option value="Ujian">Evaluasi / Ujian</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeEditKalender()" class="px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-100 rounded-xl">Batal</button>
                <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-violet-600 hover:bg-violet-700 rounded-xl shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditKalender(id, nama, mulai, selesai, jenis) {
        document.getElementById('edit-kalender-form').action = '/admin/kalender/' + id;
        document.getElementById('edit-nama-kegiatan').value = nama;
        document.getElementById('edit-tanggal-mulai').value = mulai;
        document.getElementById('edit-tanggal-selesai').value = selesai;
        document.getElementById('edit-jenis').value = jenis;
        document.getElementById('edit-kalender-modal').classList.remove('hidden');
    }

    function closeEditKalender() {
        document.getElementById('edit-kalender-modal').classList.add('hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEditKalender();
        }
    });
</script>
@endsection
