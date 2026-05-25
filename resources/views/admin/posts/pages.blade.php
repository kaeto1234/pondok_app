@extends('layouts.admin')
@section('title', 'Halaman Statis')
@section('content')

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Halaman Statis</h1>
            <p class="text-sm text-gray-500 mt-1">Profil, fasilitas, kontak, dan halaman lainnya</p>
        </div>
        <a href="{{ route('admin.posts.create', ['type' => 'page']) }}"
            class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
            <i class="fas fa-plus mr-2"></i> Tambah Halaman
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif

    {{-- Search & Filter --}}
    <div class="mb-6 flex gap-3">
        <div class="flex-1">
            <x-search-bar placeholder="Cari judul halaman..." />
        </div>
        <select onchange="window.location.href=updateQueryParam('status', this.value)"
            class="border rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Judul</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Slug</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Urutan</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3 font-medium text-sm">{{ $post->title }}</td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            <a href="{{ url('/page/' . $post->slug) }}" target="_blank"
                                class="text-blue-600 hover:underline">
                                /page/{{ $post->slug }}
                            </a>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">{{ $post->menu_order }}</td>
                        <td class="px-6 py-3">
                            @if ($post->published_at)
                                <span
                                    class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full font-semibold">Published</span>
                            @else
                                <span
                                    class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full font-semibold">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.posts.edit', $post->id) }}"
                                    class="text-yellow-600 hover:text-yellow-800 text-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                        onclick="return confirm('Yakin hapus halaman ini?')">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada halaman statis.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($posts->hasPages())
            <div class="px-6 py-4 border-t bg-gray-50">{{ $posts->links() }}</div>
        @endif
    </div>

    <script>
        function updateQueryParam(key, value) {
            const url = new URL(window.location.href);
            if (value) url.searchParams.set(key, value);
            else url.searchParams.delete(key);
            url.searchParams.delete('page');
            return url.toString();
        }
    </script>
@endsection
