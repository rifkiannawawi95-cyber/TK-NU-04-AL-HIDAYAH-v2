@extends('layouts.admin')
@section('title', 'Kehadiran Siswa')
@section('header', 'Input Kehadiran Siswa')
@section('content')
<div class="bg-white rounded-lg shadow mb-6">
    <div class="p-4 border-b">
        <form method="GET" class="flex items-center gap-4">
            <label class="font-bold">Kelas:</label>
            <select name="kelas" class="border rounded p-2" onchange="this.form.submit()">
                <option value="A" {{ $kelas == 'A' ? 'selected' : '' }}>Kelas A</option>
                <option value="B" {{ $kelas == 'B' ? 'selected' : '' }}>Kelas B</option>
            </select>
            <label class="font-bold ml-4">Tanggal:</label>
            <input type="date" name="tanggal" value="{{ $tanggal }}" class="border rounded p-2" onchange="this.form.submit()">
            <a href="{{ route('user.kehadiransiswa.rekap') }}" class="ml-auto text-blue-600 hover:underline"><i class="fas fa-file-alt"></i> Lihat Rekap</a>
        </form>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <form action="{{ route('user.kehadiransiswa.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Kehadiran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($siswas as $siswa)
                    @php $hadir = $kehadirans->get($siswa->id); @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $siswa->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select name="status[{{ $siswa->id }}]" class="border rounded p-1">
                                <option value="">-- Pilih --</option>
                                <option value="Hadir" {{ ($hadir && $hadir->status == 'Hadir') ? 'selected' : '' }}>Hadir</option>
                                <option value="Izin" {{ ($hadir && $hadir->status == 'Izin') ? 'selected' : '' }}>Izin</option>
                                <option value="Sakit" {{ ($hadir && $hadir->status == 'Sakit') ? 'selected' : '' }}>Sakit</option>
                                <option value="Alpa" {{ ($hadir && $hadir->status == 'Alpa') ? 'selected' : '' }}>Alpa</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="text" name="keterangan[{{ $siswa->id }}]" value="{{ $hadir->keterangan ?? '' }}" class="border rounded p-1 w-full" placeholder="Opsional...">
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center">Belum ada data siswa di kelas ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($siswas->count() > 0)
        <div class="p-4 text-right border-t">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded font-bold hover:bg-green-700">Simpan Kehadiran</button>
        </div>
        @endif
    </form>
</div>
@endsection
