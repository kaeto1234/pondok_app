@extends('layouts.app')
@section('title', $category->name)
@section('content')

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">

            {{-- Breadcrumb --}}
            <div class="text-sm text-gray-500 mb-6">
                <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-[#166534]">{{ $category->name }}</span>
            </div>

            {{-- Header --}}
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mb-4">
                    <i class="fas fa-{{ $category->icon ?? 'folder' }} text-2xl text-primary"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-white mb-3">{{ $category->name }}</h1>
                @if ($category->description)
                    <p class="text-gray-500 dark:text-gray-400 max-w-xl mx-auto">{{ $category->description }}</p>
                @endif
                <div class="w-24 h-1 bg-primary mx-auto mt-4 rounded-full"></div>
            </div>

            {{-- Search --}}
            <div class="mb-8 max-w-lg mx-auto">
                <form method="GET" action="{{ url('/kategori/' . $category->slug) }}" class="flex gap-2">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari di {{ $category->name }}..."
                            class="w-full pl-9 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-transparent dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                        @if (request('search'))
                            <a href="{{ url('/kategori/' . $category->slug) }}"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-sm"></i>
                            </a>
                        @endif
                    </div>
                    <button type="submit"
                        class="bg-primary text-white px-5 py-2.5 rounded-lg text-sm hover:bg-[#14532d] transition font-semibold">
                        Cari
                    </button>
                </form>

                @if (request('search'))
                    <p class="text-sm text-gray-500 mt-2 text-center">
                        Hasil pencarian untuk "<span class="font-semibold text-gray-700">{{ request('search') }}</span>"
                        — {{ $posts->total() }} ditemukan
                    </p>
                @endif
            </div>

            {{-- Grid Konten --}}
            @if ($posts->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($posts as $item)
                        <a href="{{ url('/page/' . $item->slug) }}"
                            class="group bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">

                            {{-- Gambar --}}
                            <div
                                class="h-48 bg-gray-100 dark:bg-gray-700 overflow-hidden flex items-center justify-center relative">
                                @if ($item->featured_image)
                                    <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="flex flex-col items-center text-gray-400">
                                        <i class="fas fa-{{ $category->icon ?? 'file-alt' }} text-5xl mb-2"></i>
                                        <span class="text-xs">{{ $category->name }}</span>
                                    </div>
                                @endif

                                {{-- Badge kategori --}}
                                <div class="absolute top-3 left-3">
                                    <span class="bg-primary text-white text-xs px-2 py-1 rounded-full font-semibold">
                                        {{ $category->name }}
                                    </span>
                                </div>
                            </div>

                            {{-- Konten --}}
                            <div class="p-5 flex flex-col flex-1">
                                <h3
                                    class="text-lg font-bold text-gray-800 dark:text-white mb-2 group-hover:text-primary transition line-clamp-2">
                                    {{ $item->title }}
                                </h3>

                                @if ($item->published_at)
                                    <p class="text-xs text-gray-400 dark:text-gray-500 mb-3 flex items-center gap-1">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $item->published_at->format('d M Y') }}
                                    </p>
                                @endif

                                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed flex-1">
                                    {{ Str::limit(strip_tags($item->content), 120) }}
                                </p>

                                <div class="mt-4 flex items-center justify-between">
                                    <span class="text-primary text-sm font-semibold group-hover:underline">
                                        @if ($category->slug == 'fasilitas')
                                            Lihat detail →
                                        @else
                                            Baca selengkapnya →
                                        @endif
                                    </span>
                                    <i
                                        class="fas fa-arrow-right text-primary text-xs opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if ($posts->hasPages())
                    <div class="mt-10 flex justify-center">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                {{-- Empty state --}}
                <div class="text-center py-16">
                    <div
                        class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-4xl text-gray-300"></i>
                    </div>
                    @if (request('search'))
                        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-400 mb-2">
                            Tidak ada hasil untuk "{{ request('search') }}"
                        </h3>
                        <p class="text-gray-400 mb-4">Coba kata kunci yang berbeda</p>
                        <a href="{{ url('/kategori/' . $category->slug) }}" class="text-primary hover:underline text-sm">
                            ← Lihat semua {{ $category->name }}
                        </a>
                    @else
                        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-400">
                            Belum ada konten di {{ $category->name }}
                        </h3>
                    @endif
                </div>
            @endif

        </div>
    </div>
@endsection
