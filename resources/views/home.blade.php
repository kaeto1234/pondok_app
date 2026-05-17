@extends('layouts.app')

@section('title', 'Beranda - Pondok Pesantren Roudlotut Tullab')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-primary to-primaryDark text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            @if ($heroIconKiri)
                <i class="{{ $heroIconKiri->content }} text-9xl absolute top-10 left-10"></i>
            @endif
            @if ($heroIconKanan)
                <i class="{{ $heroIconKanan->content }} text-8xl absolute bottom-10 right-10"></i>
            @endif
        </div>
        <div class="container mx-auto px-4 py-20 md:py-28 relative z-10">
            <div class="text-center fade-in">
                @if ($heroTitle)
                    <h1 class="text-4xl md:text-6xl font-bold mb-4">{!! $heroTitle->content !!}</h1>
                @endif
                @if ($heroSubtitle)
                    <p class="text-xl md:text-2xl text-white/90 max-w-2xl mx-auto">{{ $heroSubtitle->content }}</p>
                @endif
                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                    @if ($heroBtnKiri)
                        @php
                            $btn = explode('|', $heroBtnKiri->content);
                        @endphp
                        <a href="{{ url($btn[1]) }}"
                            class="{{ $btn[2] }} px-8 py-3 rounded-full font-semibold hover:opacity-90 transition shadow-lg inline-block">
                            {{ $btn[0] }}
                        </a>
                    @endif
                    @if ($heroBtnKanan)
                        @php
                            $btn = explode('|', $heroBtnKanan->content);
                        @endphp
                        <a href="{{ url($btn[1]) }}"
                            class="{{ $btn[2] }} px-8 py-3 rounded-full font-semibold hover:opacity-90 transition shadow-lg inline-block">
                            {{ $btn[0] }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik -->
    @if ($statistik->count())
        <section class="py-12 bg-gray-50 dark:bg-gray-800 transition-colors">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    @foreach ($statistik as $item)
                        <div class="hover-scale">
                            <div class="text-4xl font-bold text-primary">{{ $item->content }}</div>
                            <div class="text-gray-600 dark:text-gray-400 mt-1">{{ $item->title }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Sambutan Pimpinan -->
    @if ($sambutan)
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row gap-12 items-start">
                    <!-- TEKS - Kiri -->
                    <div class="md:w-1/2">
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Sambutan Pimpinan</h2>
                        <div class="text-gray-600 dark:text-gray-300 leading-relaxed mb-4">
                            {!! Str::limit(strip_tags($sambutan->content), 300) !!}
                        </div>
                        <a href="{{ url('/' . $sambutan->slug) }}"
                            class="text-primary font-semibold hover:underline mt-2 inline-block">Baca selengkapnya →</a>
                    </div>

                    <!-- FOTO - Kanan -->
                    <div class="md:w-1/2 flex justify-center md:justify-end">
                        @if ($sambutan->featured_image)
                            <img src="{{ asset('storage/' . $sambutan->featured_image) }}"
                                class="w-64 h-64 rounded-full object-cover shadow-lg">
                        @else
                            <div
                                class="w-64 h-64 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-circle text-8xl text-gray-400 dark:text-gray-500"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Program Unggulan -->
    @if ($programUnggulan->count())
        <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-4">Program Unggulan</h2>
                <p class="text-center text-gray-600 dark:text-gray-400 mb-12 max-w-2xl mx-auto">
                    Berbagai program unggulan untuk membentuk santri yang berkualitas
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($programUnggulan as $item)
                        <div
                            class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 text-center hover:shadow-xl transition hover-scale">
                            @if ($item->featured_image)
                                <img src="{{ asset('storage/' . $item->featured_image) }}"
                                    class="w-20 h-20 rounded-full mx-auto mb-4 object-cover">
                            @else
                                <div
                                    class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-star text-3xl text-primary"></i>
                                </div>
                            @endif
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">{{ $item->title }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ Str::limit(strip_tags($item->content), 100) }}
                            </p>
                            <a href="{{ url('/' . $item->slug) }}"
                                class="text-primary font-semibold hover:underline mt-3 inline-block">Selengkapnya →</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Fasilitas Preview -->
    @if ($fasilitasPreview->count())
        <section class="py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-4">Fasilitas Pondok</h2>
                <p class="text-center text-gray-600 dark:text-gray-400 mb-12 max-w-2xl mx-auto">
                    Sarana dan prasarana yang mendukung kenyamanan belajar santri
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($fasilitasPreview as $item)
                        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-5 text-center hover-scale">
                            @if ($item->featured_image)
                                <img src="{{ asset('storage/' . $item->featured_image) }}"
                                    class="w-16 h-16 mx-auto mb-3 rounded-full object-cover">
                            @else
                                <i class="fas fa-building text-4xl text-primary mb-3"></i>
                            @endif
                            <h3 class="font-semibold text-gray-800 dark:text-white">{{ $item->title }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ Str::limit(strip_tags($item->content), 50) }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="{{ url('/fasilitas') }}" class="text-primary font-semibold hover:underline">Lihat semua
                        fasilitas →</a>
                </div>
            </div>
        </section>
    @endif

    <!-- Berita Terbaru -->
    @if ($beritaTerbaru->count())
        <section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-4">Berita Terbaru</h2>
                <p class="text-center text-gray-600 dark:text-gray-400 mb-12">Informasi terkini seputar kegiatan pondok</p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($beritaTerbaru as $item)
                        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md overflow-hidden hover-scale">
                            @if ($item->featured_image)
                                <img src="{{ asset('storage/' . $item->featured_image) }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div class="h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-5xl text-gray-400"></i>
                                </div>
                            @endif
                            <div class="p-5">
                                <div class="text-sm text-primary mb-2">{{ date('d M Y', strtotime($item->published_at)) }}
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">{{ $item->title }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                    {{ Str::limit(strip_tags($item->content), 100) }}</p>
                                <a href="{{ url('/' . $item->slug) }}"
                                    class="text-primary text-sm font-semibold hover:underline mt-3 inline-block">Baca
                                    selengkapnya →</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <a href="{{ url('/berita') }}"
                        class="bg-primary text-white px-6 py-2 rounded-lg font-semibold hover:bg-primaryDark transition">Lihat
                        Semua Berita</a>
                </div>
            </div>
        </section>
    @endif

    <!-- CTA PPDB -->
    @if ($ctaTitle || $ctaDesc || $ctaButton)
        <section class="py-16 bg-gradient-to-r from-primary to-primaryDark text-white">
            <div class="container mx-auto px-4 text-center">
                @if ($ctaTitle)
                    <h2 class="text-3xl font-bold mb-4">{{ $ctaTitle->content }}</h2>
                @endif
                @if ($ctaDesc)
                    <p class="text-white/90 mb-8 max-w-2xl mx-auto">{{ $ctaDesc->content }}</p>
                @endif
                @if ($ctaButton)
                    @php
                        $btn = explode('|', $ctaButton->content);
                    @endphp
                    <a href="{{ url($btn[1]) }}"
                        class="{{ $btn[2] }} px-8 py-3 rounded-full font-semibold hover:opacity-90 transition shadow-lg inline-block">
                        {{ $btn[0] }}
                    </a>
                @endif
            </div>
        </section>
    @endif
@endsection
