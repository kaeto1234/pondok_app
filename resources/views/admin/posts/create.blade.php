@extends('layouts.admin')

@section('title', 'Tambah Post')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Post</h1>
        <p class="text-gray-500">Menambahkan konten baru</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Judul</label>
                    <input type="text" name="title" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                    <select name="post_category_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Tipe Post</label>
                    <select name="post_type" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option value="post">Post (Blog/Berita)</option>
                        <option value="page">Page (Halaman Statis)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Gambar</label>
                    <input type="file" name="featured_image" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at" value="{{ now()->format('Y-m-d\TH:i') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-gray-700 font-medium mb-2">Konten</label>
                <textarea name="content" id="content" rows="15" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('content') }}</textarea>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit" class="bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                    Simpan
                </button>
                <a href="{{ route('admin.posts.index') }}"
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <!-- SUMMERNOTE SCRIPT -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 500,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
@endsection
