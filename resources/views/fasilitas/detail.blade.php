@extends('layouts.app')

@section('title', $title . ' - Fasilitas Pondok Pesantren')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/fasilitas') }}" class="hover:text-[#166534]">Fasilitas</a>
            <span class="mx-2">/</span>
            <span class="text-[#166534]">{{ $title }}</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-[#166534]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="{{ $icon }} text-4xl text-[#166534]"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-2">{{ $title }}</h1>
        </div>

        <!-- Gambar -->
        <div class="bg-gray-200 dark:bg-gray-700 rounded-xl h-80 flex items-center justify-center mb-8">
            <i class="{{ $icon }} text-8xl text-gray-500"></i>
        </div>

        <!-- Konten -->
        <div class="prose prose-lg max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
            <p>{{ $description }}</p>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-8 text-center">
            <a href="{{ url('/fasilitas') }}" class="inline-flex items-center gap-2 text-[#166534] hover:underline">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Fasilitas
            </a>
        </div>
    </div>
</div>
@endsection