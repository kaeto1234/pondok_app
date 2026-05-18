@extends('layouts.admin')
@section('title', 'Manajemen Kitab')
@section('content')

<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Kitab</h1>
    <a href="{{ route('admin.kitab.create') }}" class="bg-navy-primary text-white px-4 py-2 rounded-lg hover:bg-navy-hover transition">
        <i class="fas fa-plus mr-2"></i> Tambah Kitab
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
@endif

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama Kitab</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Pengarang</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Penerbit</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tahun</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Mata Pelajaran</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kitab as $k)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $k->nama_kitab }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $k->pengarang ?? '-' }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $k->penerbit ?? '-' }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $k->tahun_terbit ?? '-' }}</td>
                <td class="px-6 py-4">
                    <div class="flex flex-wrap gap-1">
                        @forelse($k->mataPelajaran as $m)
                            <span class="px-2 py-0.5 text-xs bg-blue-100 text-blue-700 rounded-full">{{ $m->nama_mapel }}</span>
                        @empty
                            <span class="text-xs text-gray-400 italic">Belum ada</span>
                        @endforelse
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.kitab.edit', $k->id) }}" class="text-yellow-600 hover:text-yellow-800 text-sm">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <form action="{{ route('admin.kitab.destroy', $k->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                onclick="return confirm('Yakin hapus kitab ini?')">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data kitab.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($kitab->hasPages())
        <div class="px-6 py-4 border-t bg-gray-50">{{ $kitab->links() }}</div>
    @endif
</div>
@endsection