@extends('layouts.admin')
@section('title', 'Menu Navigasi')
@section('content')

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Menu Navigasi</h1>
        <a href="{{ route('admin.menus.create') }}"
            class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
            <i class="fas fa-plus mr-2"></i> Tambah Menu
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif

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
                @forelse($menus as $menu)
                    {{-- Menu Utama --}}
                    <tr class="border-b bg-gray-50">
                        <td class="px-6 py-3 font-semibold text-gray-800">{{ $menu->label }}</td>
                        <td class="px-6 py-3">
                            @if ($menu->post)
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">Halaman</span>
                            @elseif($menu->link)
                                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">Link</span>
                            @else
                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded">Grup</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-600">
                            @if ($menu->post)
                                {{ $menu->post->post->title ?? '-' }}
                            @elseif($menu->link)
                                {{ $menu->link->url ?? '-' }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-3 text-sm">{{ $menu->order }}</td>
                        <td class="px-6 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                    class="text-yellow-600 hover:text-yellow-800 text-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                        onclick="return confirm('Hapus menu {{ $menu->label }}? Submenu juga akan terhapus.')">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- Submenu --}}
                    @foreach ($menu->children as $child)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3 text-sm text-gray-600 pl-10">
                                <span class="text-gray-400 mr-1">↳</span> {{ $child->label }}
                            </td>
                            <td class="px-6 py-3">
                                @if ($child->post)
                                    <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">Halaman</span>
                                @elseif($child->link)
                                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">Link</span>
                                @else
                                    <span class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-600">
                                @if ($child->post)
                                    {{ $child->post->post->title ?? '-' }}
                                @elseif($child->link)
                                    {{ $child->link->url ?? '-' }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-3 text-sm">{{ $child->order }}</td>
                            <td class="px-6 py-3">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.menus.edit', $child->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800 text-sm">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.menus.destroy', $child->id) }}" method="POST"
                                        class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                            onclick="return confirm('Hapus submenu {{ $child->label }}?')">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada menu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
