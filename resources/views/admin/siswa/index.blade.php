@extends('layouts.admin')
@section('title', 'Data Siswa')
@section('header', 'Manajemen Data Siswa')
@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Siswa Baru</h3>
    <form action="{{ route('admin.siswa.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="nama" class="mt-1 p-2 border rounded w-full" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">NIS</label>
            <input type="text" name="nis" class="mt-1 p-2 border rounded w-full">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="mt-1 p-2 border rounded w-full" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Kelas</label>
            <select name="kelas" class="mt-1 p-2 border rounded w-full" required>
                <option value="A">Kelas A</option>
                <option value="B">Kelas B</option>
            </select>
        </div>
        <div class="md:col-span-4 text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Siswa</button>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">Daftar Siswa</h3>
        <form method="GET" class="flex gap-2">
            <select name="kelas" class="border rounded p-1" onchange="this.form.submit()">
                <option value="">Semua Kelas</option>
                <option value="A" {{ request('kelas') == 'A' ? 'selected' : '' }}>Kelas A</option>
                <option value="B" {{ request('kelas') == 'B' ? 'selected' : '' }}>Kelas B</option>
            </select>
            <input type="text" name="search" placeholder="Cari nama..." value="{{ request('search') }}" class="border rounded p-1">
            <button type="submit" class="bg-gray-200 px-3 py-1 rounded">Cari</button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama / NIS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">L/P</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($siswas as $siswa)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-bold">{{ $siswa->nama }}</div>
                        <div class="text-xs text-gray-500">{{ $siswa->nis ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->jenis_kelamin }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">Kelas {{ $siswa->kelas }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $siswas->links() }}
    </div>
</div>
@endsection
