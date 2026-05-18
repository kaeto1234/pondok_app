@extends('layouts.admin')

@section('title', 'Jenis Berkas')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Jenis Berkas</h1>
    <a href="{{ route('admin.jenis-berkas.create') }}" class="bg-navy-primary text-white px-4 py-2 rounded-lg hover:bg-navy-hover transition">
        <i class="fas fa-plus mr-2"></i> Tambah Jenis Berkas
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama Berkas</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tipe File</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Ukuran Maksimal</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jenisBerkas as $jb)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $jb->nama }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $jb->tipe_file }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ number_format($jb->ukuran_maksimal / 1024, 2) }} MB</td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.jenis-berkas.edit', $jb->id) }}" class="text-yellow-600 hover:text-yellow-800 text-sm">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <form action="{{ route('admin.jenis-berkas.destroy', $jb->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada data jenis berkas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection