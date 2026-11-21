@extends('layouts.admin')
@section('title', 'Kehadiran Guru')
@section('header', 'Input Kehadiran Guru')
@section('content')
<div class="bg-white rounded-lg shadow mb-6">
    <div class="p-4 border-b">
        <form method="GET" class="flex items-center gap-4">
            <label class="font-bold">Pilih Tanggal:</label>
            <input type="date" name="tanggal" value="{{ $tanggal }}" class="border rounded p-2" onchange="this.form.submit()">
            <a href="{{ route('admin.kehadiranguru.rekap') }}" class="ml-auto text-blue-600 hover:underline"><i class="fas fa-file-alt"></i> Lihat Rekap</a>
        </form>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <form action="{{ route('admin.kehadiranguru.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Guru</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Kehadiran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($gurus as $guru)
                    @php $hadir = $kehadirans->get($guru->id); @endphp
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $guru->nama }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select name="status[{{ $guru->id }}]" class="border rounded p-1">
                                <option value="">-- Pilih --</option>
                                <option value="Hadir" {{ ($hadir && $hadir->status == 'Hadir') ? 'selected' : '' }}>Hadir</option>
                                <option value="Izin" {{ ($hadir && $hadir->status == 'Izin') ? 'selected' : '' }}>Izin (-Rp5.000)</option>
                                <option value="Sakit" {{ ($hadir && $hadir->status == 'Sakit') ? 'selected' : '' }}>Sakit (-Rp5.000)</option>
                                <option value="Alpa" {{ ($hadir && $hadir->status == 'Alpa') ? 'selected' : '' }}>Alpa (-Rp5.000)</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="text" name="keterangan[{{ $guru->id }}]" value="{{ $hadir->keterangan ?? '' }}" class="border rounded p-1 w-full" placeholder="Opsional...">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 text-right border-t">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded font-bold hover:bg-green-700">Simpan Kehadiran</button>
        </div>
    </form>
</div>
@endsection
