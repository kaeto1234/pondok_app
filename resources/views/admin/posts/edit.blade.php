@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Post</h1>
        <p class="text-gray-500">Mengubah konten yang sudah ada</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Judul</label>
                    <input type="text" name="title" value="{{ $post->title }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Kategori</label>
                    <select name="post_category_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $post->post_category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Tipe Post</label>
                    <select name="post_type" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option value="post" {{ $post->post_type == 'post' ? 'selected' : '' }}>Post (Blog/Berita)
                        </option>
                        <option value="page" {{ $post->post_type == 'page' ? 'selected' : '' }}>Page (Halaman Statis)
                        </option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Gambar Unggulan</label>
                    @if ($post->featured_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $post->featured_image) }}"
                                class="w-32 h-32 object-cover rounded">
                            <p class="text-xs text-gray-400">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="featured_image" accept="image/*"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-2">Tanggal Publikasi</label>
                    <input type="datetime-local" name="published_at"
                        value="{{ $post->published_at ? date('Y-m-d\TH:i', strtotime($post->published_at)) : '' }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-gray-700 font-medium mb-2">Konten</label>
                <textarea name="content" id="content" rows="15" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $post->content }}</textarea>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit" class="bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                    <i class="fas fa-save mr-2"></i> Update
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
