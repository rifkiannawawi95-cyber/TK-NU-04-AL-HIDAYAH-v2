@extends('layouts.admin')
@section('title', 'Laporan')
@section('header', 'Laporan Sekolah')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow border-t-4 border-blue-500 hover:shadow-md transition">
        <a href="{{ route('admin.laporan.guru') }}" class="block p-6">
            <div class="flex items-center">
                <div class="p-4 bg-blue-100 rounded-full text-blue-600 mr-4">
                    <i class="fas fa-chalkboard-teacher fa-2x"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Laporan Kehadiran Guru</h3>
                    <p class="text-gray-500 text-sm mt-1">Lihat rekap absensi dan potongan gaji guru.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="bg-white rounded-lg shadow border-t-4 border-green-500 hover:shadow-md transition">
        <a href="{{ route('admin.laporan.siswa') }}" class="block p-6">
            <div class="flex items-center">
                <div class="p-4 bg-green-100 rounded-full text-green-600 mr-4">
                    <i class="fas fa-user-graduate fa-2x"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Laporan Kehadiran Siswa</h3>
                    <p class="text-gray-500 text-sm mt-1">Lihat rekap absensi siswa per kelas.</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
