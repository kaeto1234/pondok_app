@extends('layouts.admin')
@section('title', 'Menu Navigasi')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Menu Navigasi</h1>
        <p class="text-sm text-gray-500 mt-1">
            <i class="fas fa-info-circle mr-1"></i>
            Kelola menu navigasi website, termasuk submenu
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KIRI: FORM TAMBAH MENU --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-6 max-h-[calc(100vh-6rem)] overflow-y-auto">
                <h2 class="text-lg font-bold text-gray-800 mb-4">
                    <i class="fas fa-plus-circle text-navy-primary mr-2"></i> Tambah Menu
                </h2>

                <form action="{{ route('admin.menus.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Label Menu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="label" value="{{ old('label') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            placeholder="Contoh: Profil, Berita, Kegiatan" required>
                        @error('label')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Parent Menu</label>
                        <select name="parent_id"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary">
                            <option value="">Tanpa Parent (Menu Utama)</option>
                            @foreach ($menusList as $m)
                                <option value="{{ $m->id }}" {{ old('parent_id') == $m->id ? 'selected' : '' }}>
                                    {{ $m->label }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-400 mt-1">Pilih jika ingin membuat submenu</p>
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Menu <span
                                class="text-red-500">*</span></label>
                        <div class="flex gap-3">
                            <label class="inline-flex items-center text-sm">
                                <input type="radio" name="type" value="post" checked class="mr-1"
                                    onclick="toggleMenuType('post')">
                                Halaman
                            </label>
                            <label class="inline-flex items-center text-sm">
                                <input type="radio" name="type" value="link" class="mr-1"
                                    onclick="toggleMenuType('link')">
                                Link
                            </label>
                        </div>
                    </div>

                    <div id="post_select" class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Halaman</label>
                        <select name="post_id"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary">
                            <option value="">-- Pilih Halaman --</option>
                            @foreach ($posts as $post)
                                <option value="{{ $post->id }}" {{ old('post_id') == $post->id ? 'selected' : '' }}>
                                    {{ $post->title }} ({{ $post->post_type }})
                                </option>
                            @endforeach
                        </select>
                        @error('post_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="link_input" class="mb-3 hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL / Link</label>
                        <input type="text" name="url" value="{{ old('url') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            placeholder="https://... atau /kontak">
                        @error('url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary">
                        <p class="text-xs text-gray-400 mt-1">Semakin kecil angka, semakin atas posisinya</p>
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center text-sm">
                            <input type="checkbox" name="is_active" value="1" checked class="mr-2 rounded">
                            <span class="text-gray-700">Aktif (ditampilkan di menu)</span>
                        </label>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="flex-1 bg-navy-primary text-white px-4 py-2 rounded-lg hover:bg-navy-hover transition text-sm">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                        <button type="reset"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- KANAN: TABEL DAFTAR MENU --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
                    <h2 class="font-semibold text-gray-700">
                        <i class="fas fa-bars text-navy-primary mr-2"></i> Daftar Menu
                    </h2>
                    <span class="text-xs text-gray-500">Total: {{ $menus->count() }} menu utama</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Label</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tipe</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">URL / Halaman
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Urutan</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus as $menu)
                                {{-- Menu Utama --}}
                                <tr class="border-b bg-gray-50">
                                    <td class="px-4 py-3 font-semibold text-gray-800 text-sm">{{ $menu->label }}</td>
                                    <td class="px-4 py-3">
                                        @if ($menu->post)
                                            <span
                                                class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">Halaman</span>
                                        @elseif($menu->link)
                                            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">Link</span>
                                        @else
                                            <span class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded">Grup</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        @if ($menu->post)
                                            {{ $menu->post->post->title ?? '-' }}
                                        @elseif($menu->link)
                                            {{ $menu->link->url ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm">{{ $menu->order }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                                class="text-yellow-600 hover:text-yellow-800 text-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST"
                                                class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                                    onclick="return confirm('Hapus menu {{ $menu->label }}? Submenu juga akan terhapus.')"
                                                    title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- Submenu --}}
                                @foreach ($menu->children as $child)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm text-gray-600 pl-8">
                                            <span class="text-gray-400 mr-1">↳</span> {{ $child->label }}
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($child->post)
                                                <span
                                                    class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">Halaman</span>
                                            @elseif($child->link)
                                                <span
                                                    class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded">Link</span>
                                            @else
                                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-1 rounded">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-600">
                                            @if ($child->post)
                                                {{ $child->post->post->title ?? '-' }}
                                            @elseif($child->link)
                                                {{ $child->link->url ?? '-' }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm">{{ $child->order }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.menus.edit', $child->id) }}"
                                                    class="text-yellow-600 hover:text-yellow-800 text-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.menus.destroy', $child->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                                        onclick="return confirm('Hapus submenu {{ $child->label }}?')"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                        <i class="fas fa-bars text-3xl text-gray-300 mb-2 block"></i>
                                        Belum ada menu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script>
        function toggleMenuType(type) {
            if (type === 'post') {
                document.getElementById('post_select').classList.remove('hidden');
                document.getElementById('link_input').classList.add('hidden');
            } else {
                document.getElementById('post_select').classList.add('hidden');
                document.getElementById('link_input').classList.remove('hidden');
            }
        }

        // Jalankan saat pertama load (kalau old input type = link)
        @if (old('type') === 'link')
            toggleMenuType('link');
        @endif
    </script>
@endsection
