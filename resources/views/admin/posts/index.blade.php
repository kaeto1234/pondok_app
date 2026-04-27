@extends('layouts.admin')

@section('title', 'Manajemen Post')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Post</h1>
    <a href="{{ route('admin.posts.create') }}" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
        <i class="fas fa-plus mr-2"></i> Tambah Post
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr class="border-b">
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Judul</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Kategori</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tipe</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-3">{{ $post->title }}</td>
                <td class="px-6 py-3">{{ $post->category->name ?? '-' }}</td>
                <td class="px-6 py-3">
                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $post->post_type }}</span>
                 </td>
                <td class="px-6 py-3">
                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline">
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