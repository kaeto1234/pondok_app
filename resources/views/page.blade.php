@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container mx-auto px-4 py-8 animate-fadeIn">
        <div class="max-w-4xl mx-auto">

            <!-- Breadcrumb -->
            <div class="text-sm text-gray-500 mb-6">
                <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
                <span class="mx-2">/</span>
                @if ($post->category)
                    <a href="{{ url('/kategori/' . $post->category->slug) }}"
                        class="hover:text-[#166534]">{{ $post->category->name }}</a>
                    <span class="mx-2">/</span>
                @endif
                <span class="text-[#166534]">{{ $post->title }}</span>
            </div>

            <!-- Judul Halaman -->
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white">{{ $post->title }}</h1>
                <div class="w-24 h-1 bg-primary mx-auto mt-4 rounded-full"></div>
            </div>

            <!-- Featured Image (jika ada) -->
            @if ($post->featured_image)
                <div class="rounded-2xl overflow-hidden shadow-xl mb-8">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                        class="w-full h-80 object-cover">
                </div>
            @endif

            <!-- Konten -->
            <div class="prose prose-lg max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
                {!! nl2br($post->content) !!}
            </div>

            <!-- Tombol Kembali (khusus post) -->
            @if ($post->post_type == 'post')
                <div class="mt-8 text-center">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-primary hover:underline">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            @endif

        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
@endsection
