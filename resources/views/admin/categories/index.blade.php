@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h1>
    <a href="{{ route('admin.categories.create') }}" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
        <i class="fas fa-plus mr-2"></i> Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr class="border-b">
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Slug</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Deskripsi</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
        </thead>
        <tbody>
            @foreach($categories as $cat)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-3">{{ $cat->name }}</td>
                <td class="px-6 py-3 text-gray-500">{{ $cat->slug }}</td>
                <td class="px-6 py-3 text-gray-500">{{ Str::limit($cat->description, 50) }}</td>
                <td class="px-6 py-3">
                    <a href="{{ route('admin.categories.edit', $cat->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin?')">Hapus</button>
                    </form>
                 </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection