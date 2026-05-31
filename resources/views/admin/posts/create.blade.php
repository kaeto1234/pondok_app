@extends('layouts.admin')
@section('title', $type == 'page' ? 'Tambah Halaman' : 'Tambah Artikel')
@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $type == 'page' ? 'Tambah Halaman Statis' : 'Tambah Artikel' }}
        </h1>
        <p class="text-gray-500">Menambahkan konten baru</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Tipe sudah ditentukan dari tombol, tidak perlu pilih lagi --}}
            <input type="hidden" name="post_type" value="{{ $type }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Judul <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if ($type == 'post')
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                        <select name="post_category_id" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('post_category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if ($type == 'page')
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Urutan Menu</label>
                        <input type="number" name="menu_order" value="{{ old('menu_order', 0) }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <p class="text-xs text-gray-400 mt-1">Angka kecil tampil lebih dulu</p>
                    </div>
                @endif

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Gambar Unggulan</label>
                    <input type="file" name="featured_image" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2" id="imageInput"
                        onchange="previewImage(this)">
                    <div id="imagePreview" class="mt-2 hidden">
                        <img id="previewImg" src="" class="w-32 h-32 object-cover rounded">
                        <button type="button" onclick="removeImagePreview()"
                            class="mt-1 text-xs text-red-500 hover:text-red-700">
                            <i class="fas fa-times mr-1"></i> Hapus pilihan
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at"
                        value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <p class="text-xs text-gray-400 mt-1">Kosongkan untuk simpan sebagai draft</p>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-gray-700 font-medium mb-2">Konten</label>
                <textarea name="content" id="content" rows="15" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('content') }}</textarea>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit" class="bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <a href="{{ $type == 'page' ? route('admin.posts.pages') : route('admin.posts.index') }}"
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <x-summernote />

    @push('scripts')
        <script>
            function previewImage(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        document.getElementById('previewImg').src = e.target.result;
                        document.getElementById('imagePreview').classList.remove('hidden');
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function removeImagePreview() {
                document.getElementById('imageInput').value = '';
                document.getElementById('imagePreview').classList.add('hidden');
                document.getElementById('previewImg').src = '';
            }
        </script>
    @endpush

@endsection
