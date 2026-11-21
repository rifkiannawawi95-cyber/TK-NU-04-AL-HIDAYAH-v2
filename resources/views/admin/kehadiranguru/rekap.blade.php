@extends('layouts.admin')
@section('title', 'Rekap Kehadiran Guru')
@section('header', 'Rekap Kehadiran Guru')
@section('content')
<div class="bg-white rounded-lg shadow mb-6">
    <div class="p-4 border-b">
        <form method="GET" class="flex items-center gap-4">
            <label class="font-bold">Bulan:</label>
            <select name="bulan" class="border rounded p-2" onchange="this.form.submit()">
                @for($i=1; $i<=12; $i++)
                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ $bulan == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                @endfor
            </select>
            <select name="tahun" class="border rounded p-2" onchange="this.form.submit()">
                @for($i=date('Y'); $i>=2020; $i--)
                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </form>
    </div>
    
    <div class="p-4 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Guru</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Hadir</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Izin</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Sakit</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Alpa</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-red-500 uppercase">Potongan (Rp)</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @php $grandTotalPotongan = 0; @endphp
                @foreach($gurus as $guru)
                    @php
                        $hadir = $guru->kehadiran->where('status', 'Hadir')->count();
                        $izin = $guru->kehadiran->where('status', 'Izin')->count();
                        $sakit = $guru->kehadiran->where('status', 'Sakit')->count();
                        $alpa = $guru->kehadiran->where('status', 'Alpa')->count();
                        $potongan = ($izin + $sakit + $alpa) * 5000;
                        $grandTotalPotongan += $potongan;
                    @endphp
                    <tr>
                        <td class="px-4 py-3 font-bold">{{ $guru->nama }}</td>
                        <td class="px-4 py-3 text-center">{{ $hadir }}</td>
                        <td class="px-4 py-3 text-center">{{ $izin }}</td>
                        <td class="px-4 py-3 text-center">{{ $sakit }}</td>
                        <td class="px-4 py-3 text-center text-red-600 font-bold">{{ $alpa }}</td>
                        <td class="px-4 py-3 text-right text-red-600 font-bold">{{ number_format($potongan, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <th colspan="5" class="px-4 py-3 text-right font-bold">Total Potongan Bulan Ini:</th>
                    <th class="px-4 py-3 text-right text-red-600 font-bold text-lg">Rp {{ number_format($grandTotalPotongan, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
