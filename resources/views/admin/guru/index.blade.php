@extends('layouts.admin')
@section('title', 'Data Guru')
@section('header', 'Manajemen Data Guru')
@section('content')
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Guru Baru</h3>
    <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-5 gap-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" class="mt-1 p-2 border rounded w-full" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">NIP/NUPTK</label>
            <input type="text" name="nip" class="mt-1 p-2 border rounded w-full">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Jabatan</label>
            <input type="text" name="jabatan" class="mt-1 p-2 border rounded w-full" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">No. HP</label>
            <input type="text" name="no_hp" class="mt-1 p-2 border rounded w-full">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Foto</label>
            <input type="file" name="foto" accept="image/*" class="mt-1 p-1 border rounded w-full text-sm">
        </div>
        <div class="md:col-span-5 text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Data</button>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">Daftar Guru</h3>
        <form method="GET" class="flex gap-2">
            <input type="text" name="search" placeholder="Cari nama..." value="{{ request('search') }}" class="border rounded p-1">
            <button type="submit" class="bg-gray-200 px-3 py-1 rounded">Cari</button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama / NIP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jabatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($gurus as $index => $guru)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $gurus->firstItem() + $index }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ $guru->foto_url }}" 
                             alt="{{ $guru->nama }}"
                             class="h-12 w-12 rounded-full object-cover border border-slate-200 shadow-xs"
                             onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.svg') }}';">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-bold">{{ $guru->nama }}</div>
                        <div class="text-sm text-gray-500">{{ $guru->nip ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $guru->jabatan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                        <button onclick="editGuru({{ $guru->id }}, '{{ addslashes($guru->nama) }}', '{{ addslashes($guru->nip ?? '') }}', '{{ addslashes($guru->jabatan) }}', '{{ addslashes($guru->no_hp ?? '') }}')" class="text-yellow-600 hover:text-yellow-900"><i class="fas fa-edit"></i></button>
                        <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
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
        {{ $gurus->links() }}
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-2xl">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Edit Data Guru</h3>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="edit_nama" name="nama" class="mt-1 p-2 border rounded w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIP/NUPTK</label>
                    <input type="text" id="edit_nip" name="nip" class="mt-1 p-2 border rounded w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <input type="text" id="edit_jabatan" name="jabatan" class="mt-1 p-2 border rounded w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">No. HP</label>
                    <input type="text" id="edit_no_hp" name="no_hp" class="mt-1 p-2 border rounded w-full">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="mt-1 p-1 border rounded w-full text-sm">
                </div>
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Data</button>
            </div>
        </form>
    </div>
</div>

<script>
function editGuru(id, nama, nip, jabatan, no_hp) {
    document.getElementById('editForm').action = "/admin/guru/" + id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_nip').value = nip !== '-' ? nip : '';
    document.getElementById('edit_jabatan').value = jabatan;
    document.getElementById('edit_no_hp').value = no_hp !== '-' ? no_hp : '';
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>
@endsection
