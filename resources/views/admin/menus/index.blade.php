@extends('layouts.admin')

@section('title', 'Menu Navigasi')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Menu Navigasi</h1>
    <a href="{{ route('admin.menus.create') }}" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
        <i class="fas fa-plus mr-2"></i> Tambah Menu
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr class="border-b">
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Label</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tipe</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">URL / Halaman</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Urutan</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-3">
                    {{ $menu->label }}
                    @if($menu->children->count())
                        <ul class="ml-4 mt-2 text-gray-500 text-sm">
                        @foreach($menu->children as $child)
                            <li>↳ {{ $child->label }}</li>
                        @endforeach
                        </ul>
                    @endif
                </td>
                <td class="px-6 py-3">
                    @if($menu->post)
                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">Halaman</span>
                    @else
                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">Link</span>
                    @endif
                </td>
                <td class="px-6 py-3">
                    @if($menu->post)
                        {{ $menu->post->post->title ?? '-' }}
                    @else
                        {{ $menu->link->url ?? '-' }}
                    @endif
                </td>
                <td class="px-6 py-3">{{ $menu->order }}</td>
                <td class="px-6 py-3">
                    <a href="{{ route('admin.menus.edit', $menu->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                    <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="inline">
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