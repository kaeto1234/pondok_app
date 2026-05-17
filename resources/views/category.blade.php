@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-[#166534]">{{ $category->name }}</span>
        </div>

        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-white mb-4">{{ $category->name }}</h1>
            <div class="w-24 h-1 bg-primary mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $item)
            <a href="{{ url('/' . $item->slug) }}" class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition group">
                <div class="h-40 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                    @if($item->featured_image)
                        <img src="{{ asset('storage/' . $item->featured_image) }}" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-{{ $category->icon ?? 'file-alt' }} text-5xl text-gray-500"></i>
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">{{ $item->title }}</h3>
                    <p class="text-gray-500 text-sm mb-2">{{ date('d M Y', strtotime($item->published_at)) }}</p>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                    <span class="text-[#166534] text-sm font-semibold mt-2 inline-block">
                        @if($category->slug == 'fasilitas') Lihat detail →
                        @else Baca →
                        @endif
                    </span>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center text-gray-500">Belum ada data di {{ $category->name }}.</div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection