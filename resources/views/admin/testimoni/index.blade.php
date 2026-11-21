@extends('layouts.admin')
@section('title', 'Moderasi Testimoni & Komentar')
@section('header', 'Testimoni & Komentar Wali Santri')

@section('content')
<div class="space-y-6">

    <!-- Header Banner -->
    <div class="relative bg-gradient-to-r from-[#005A3C] via-[#006F4A] to-[#004B32] rounded-3xl p-6 sm:p-7 text-white shadow-xl shadow-emerald-950/20 border border-emerald-600/30 overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-56 h-56 bg-emerald-400/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur-md text-amber-300 border border-white/20 flex items-center justify-center text-2xl flex-shrink-0 shadow-inner">
                    <i class="fas fa-comments"></i>
                </div>
                <div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-400 text-slate-950 mb-1">
                        <i class="fas fa-shield-halved"></i> Moderasi Publik
                    </div>
                    <h2 class="text-xl sm:text-2xl font-black tracking-tight">Apa Kata Ayah & Bunda</h2>
                    <p class="text-xs sm:text-sm text-emerald-100 font-medium mt-0.5">
                        Kelola ulasan, komentar, dan testimoni wali santri sebelum ditampilkan di beranda website resmi.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ url('/#testimoni') }}" target="_blank" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold border border-white/20 transition-all">
                    <i class="fas fa-globe"></i> Lihat di Website Publik
                    <i class="fas fa-arrow-up-right-from-square text-[10px] opacity-70"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Stat Pills Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Stat 1: Total -->
        <a href="{{ route('admin.testimoni.index', ['status' => 'all']) }}" 
           class="bg-white/90 backdrop-blur-md rounded-2xl p-5 border {{ $status === 'all' ? 'border-emerald-500 ring-2 ring-emerald-500/20' : 'border-slate-200/80' }} shadow-xs hover:shadow transition-all group flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Total Komentar</p>
                <h3 class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">{{ $totalCount }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center text-xl group-hover:scale-105 transition-transform">
                <i class="fas fa-list-check"></i>
            </div>
        </a>

        <!-- Stat 2: Pending (Menunggu Persetujuan) -->
        <a href="{{ route('admin.testimoni.index', ['status' => 'pending']) }}" 
           class="bg-white/90 backdrop-blur-md rounded-2xl p-5 border {{ $status === 'pending' ? 'border-amber-500 ring-2 ring-amber-500/20' : 'border-slate-200/80' }} shadow-xs hover:shadow transition-all group flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <p class="text-[11px] font-bold text-amber-700 uppercase tracking-wider">Perlu Persetujuan</p>
                    @if($pendingCount > 0)
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                    @endif
                </div>
                <h3 class="text-2xl sm:text-3xl font-black text-amber-600 mt-1">{{ $pendingCount }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 border border-amber-100 flex items-center justify-center text-xl group-hover:scale-105 transition-transform">
                <i class="fas fa-clock"></i>
            </div>
        </a>

        <!-- Stat 3: Approved (Tayang di Publik) -->
        <a href="{{ route('admin.testimoni.index', ['status' => 'approved']) }}" 
           class="bg-white/90 backdrop-blur-md rounded-2xl p-5 border {{ $status === 'approved' ? 'border-emerald-500 ring-2 ring-emerald-500/20' : 'border-slate-200/80' }} shadow-xs hover:shadow transition-all group flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider">Tayang di Publik</p>
                <h3 class="text-2xl sm:text-3xl font-black text-emerald-700 mt-1">{{ $approvedCount }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100 flex items-center justify-center text-xl group-hover:scale-105 transition-transform">
                <i class="fas fa-circle-check"></i>
            </div>
        </a>
    </div>

    <!-- Filter Bar & Search -->
    <div class="bg-white/90 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-slate-200/80 shadow-xs flex flex-col md:flex-row md:items-center justify-between gap-4">
        <!-- Filter Tabs -->
        <div class="flex flex-wrap items-center gap-1.5 bg-slate-100/80 p-1 rounded-2xl border border-slate-200/60 w-fit">
            <a href="{{ route('admin.testimoni.index', ['status' => 'all', 'search' => $search]) }}" 
               class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all {{ $status === 'all' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                Semua ({{ $totalCount }})
            </a>
            <a href="{{ route('admin.testimoni.index', ['status' => 'pending', 'search' => $search]) }}" 
               class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 {{ $status === 'pending' ? 'bg-amber-500 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                <span>Perlu Moderasi</span>
                @if($pendingCount > 0)
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $status === 'pending' ? 'bg-white text-amber-700' : 'bg-amber-200 text-amber-900' }}">{{ $pendingCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.testimoni.index', ['status' => 'approved', 'search' => $search]) }}" 
               class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all {{ $status === 'approved' ? 'bg-emerald-600 text-white shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                Disetujui ({{ $approvedCount }})
            </a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.testimoni.index') }}" class="flex items-center gap-2">
            <input type="hidden" name="status" value="{{ $status }}">
            <div class="relative w-full sm:w-64">
                <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" 
                       name="search" 
                       value="{{ $search }}" 
                       placeholder="Cari nama atau pesan..." 
                       class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
            </div>
            <button type="submit" 
                    class="px-3.5 py-2 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl transition-all">
                Cari
            </button>
            @if($search)
                <a href="{{ route('admin.testimoni.index', ['status' => $status]) }}" 
                   class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition-all" 
                   title="Reset Pencarian">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </form>
    </div>

    <!-- Testimonial Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($testimonis as $item)
            <div class="bg-white rounded-3xl p-6 border {{ $item->is_approved ? 'border-slate-200/80 shadow-xs' : 'border-amber-300 shadow-md ring-2 ring-amber-400/20' }} flex flex-col justify-between transition-all group hover:shadow-lg">
                
                <div>
                    <!-- Card Top: Status & Date -->
                    <div class="flex items-center justify-between gap-2 mb-4">
                        @if($item->is_approved)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-800 border border-emerald-200">
                                <i class="fas fa-check-circle text-emerald-600"></i> Tayang di Publik
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-100 text-amber-900 border border-amber-300 animate-pulse">
                                <i class="fas fa-hourglass-half text-amber-600"></i> Menunggu Persetujuan
                            </span>
                        @endif

                        <span class="text-[11px] text-slate-400 font-medium">
                            {{ $item->created_at ? $item->created_at->translatedFormat('d M Y, H:i') : '-' }}
                        </span>
                    </div>

                    <!-- Star Ratings -->
                    <div class="flex items-center gap-1 text-amber-400 text-xs mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="{{ $i <= $item->rating ? 'fas' : 'far' }} fa-star"></i>
                        @endfor
                        <span class="text-slate-400 text-[11px] font-bold ml-1.5">({{ $item->rating }}/5)</span>
                    </div>

                    <!-- Message Body -->
                    <div class="relative bg-slate-50/70 rounded-2xl p-4 border border-slate-100 mb-5">
                        <i class="fas fa-quote-left text-slate-300 text-xs absolute top-2.5 left-2.5 opacity-60"></i>
                        <p class="text-xs sm:text-sm text-slate-700 leading-relaxed font-medium italic pl-3">
                            "{{ $item->pesan }}"
                        </p>
                    </div>

                    <!-- Author Info -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-black text-xs flex items-center justify-center shadow-xs flex-shrink-0">
                            {{ $item->initials }}
                        </div>
                        <div class="overflow-hidden">
                            <h4 class="text-sm font-black text-slate-900 truncate">{{ $item->nama }}</h4>
                            <p class="text-[11px] text-slate-500 font-medium truncate">{{ $item->peran }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card Actions Bottom -->
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        @if(!$item->is_approved)
                            <form action="{{ route('admin.testimoni.approve', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-xs hover:shadow transition-all">
                                    <i class="fas fa-check"></i> Setujui
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.testimoni.reject', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-amber-100 hover:bg-amber-200 text-amber-900 text-xs font-bold rounded-xl transition-all" 
                                        title="Sembunyikan dari publik">
                                    <i class="fas fa-eye-slash"></i> Tarik
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Delete Button -->
                    <form action="{{ route('admin.testimoni.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni dari {{ addslashes($item->nama) }}? Tindakan ini tidak dapat dibatalkan.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-8 h-8 rounded-xl text-rose-600 hover:bg-rose-50 flex items-center justify-center transition-colors" 
                                title="Hapus Testimoni">
                            <i class="fas fa-trash-can text-xs"></i>
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="col-span-full bg-white rounded-3xl p-12 text-center border border-slate-200/80">
                <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 mx-auto flex items-center justify-center text-2xl mb-4">
                    <i class="fas fa-comment-slash"></i>
                </div>
                <h4 class="text-base font-bold text-slate-800">Belum Ada Komentar / Testimoni</h4>
                <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto">
                    @if($status === 'pending')
                        Semua komentar sudah diproses. Tidak ada testimoni yang menunggu persetujuan saat ini.
                    @else
                        Belum ada data ulasan yang cocok dengan kriteria filter saat ini.
                    @endif
                </p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($testimonis->hasPages())
        <div class="pt-4">
            {{ $testimonis->links() }}
        </div>
    @endif

</div>
@endsection
