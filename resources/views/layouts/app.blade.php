<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pondok Pesantren Roudlotut Tullab')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#166534',
                        primaryLight: '#22c55e',
                        primaryDark: '#14532d',
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .fade-in {
            animation: fadeIn 1s ease-in;
        }

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
    </style>

    @stack('styles')
</head>

<body class="bg-white dark:bg-gray-900 transition-colors duration-300">

    <!-- NAVBAR -->
    <nav class="bg-[#166534] dark:bg-gray-800 shadow-lg sticky top-0 z-50 transition-colors">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-3">

                <!-- LOGO -->
                <div class="flex items-center space-x-3 flex-shrink-0 mr-8">
                    <img src="{{ asset('asset/logo_ponpes.png') }}" alt="Logo Ponpes Roudlotut Tullab"
                        class="h-20 w-auto">
                    <span class="text-white font-bold text-xl whitespace-nowrap">Roudlotut Tullab</span>
                </div>

                <!-- DESKTOP MENU -->
                <div class="hidden md:flex items-center space-x-1">
                    <!-- Beranda (Hardcode dulu) -->
                    <a href="{{ url('/') }}"
                        class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm">Beranda</a>

                    @php
                        $menus = App\Models\Menu::with(['children', 'post', 'link'])
                            ->whereNull('parent_id')
                            ->where('is_active', true)
                            ->orderBy('order')
                            ->get();
                    @endphp

                    @foreach ($menus as $menu)
                        @if ($menu->children->count() > 0)
                            <!-- Dropdown Menu -->
                            <div class="relative group">
                                <a href="#"
                                    class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm inline-flex items-center">
                                    {{ $menu->label }}
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </a>
                                <div
                                    class="absolute left-0 mt-1 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                    <div class="py-2">
                                        @foreach ($menu->children as $child)
                                            <a href="{{ $child->link ? $child->link->url : url('/' . ($child->post->post->slug ?? '')) }}"
                                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                {{ $child->label }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Single Menu -->
                            <a href="{{ $menu->link ? $menu->link->url : url('/' . ($menu->post->post->slug ?? '')) }}"
                                class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm">
                                {{ $menu->label }}
                            </a>
                        @endif
                    @endforeach
                </div>

                <!-- RIGHT SECTION -->
                <div class="flex items-center space-x-3 flex-shrink-0">
                    <a href="{{ url('/ppdb') }}"
                        class="hidden md:block bg-white text-[#166534] px-4 py-1.5 rounded-lg font-semibold text-sm hover:bg-gray-100 transition shadow-md">
                        PPDB
                    </a>
                    <button id="darkModeToggle"
                        class="text-white text-lg focus:outline-none hover:bg-white/10 p-2 rounded-lg transition">
                        <i id="darkModeIcon" class="fas fa-moon"></i>
                    </button>
                    <button id="mobile-menu-button"
                        class="md:hidden text-white focus:outline-none hover:bg-white/10 p-2 rounded-lg transition">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- MOBILE MENU -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 space-y-2">
                <a href="{{ url('/') }}"
                    class="block text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition">Beranda</a>

                @foreach ($menus as $menu)
                    @if ($menu->children->count() > 0)
                        <!-- Mobile Dropdown -->
                        <div x-data="{ open: false }" class="w-full">
                            <button @click="open = !open"
                                class="w-full text-left text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition flex justify-between items-center">
                                {{ $menu->label }}
                                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" class="ml-4 space-y-1" x-cloak>
                                @foreach ($menu->children as $child)
                                    <a href="{{ $child->link ? $child->link->url : url('/' . ($child->post->post->slug ?? '')) }}"
                                        class="block text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm">
                                        {{ $child->label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $menu->link ? $menu->link->url : url('/' . ($menu->post->post->slug ?? '')) }}"
                            class="block text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition">
                            {{ $menu->label }}
                        </a>
                    @endif
                @endforeach

                <a href="{{ url('/ppdb') }}"
                    class="block bg-white text-[#166534] px-4 py-2 rounded-lg font-semibold text-center mt-2">PPDB</a>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                <!-- Kolom 1: Logo & Nama Yayasan -->
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-mosque text-2xl text-primaryLight"></i>
                        @if ($yayasan && $yayasan->nama_yayasan)
                            <span class="font-bold text-xl">{{ $yayasan->nama_yayasan }}</span>
                        @else
                            <span class="font-bold text-xl">Ponpes Roudlotut Tullab</span>
                        @endif
                    </div>
                    <p class="text-gray-400 text-sm mt-3 leading-relaxed">
                        Pondok Pesantren berbasis akhlak dan ilmu pengetahuan.
                    </p>
                </div>

                <!-- Kolom 2: Tautan Cepat -->
                <div>
                    <h4 class="font-semibold text-lg mb-4 relative">
                        Tautan Cepat
                        <span class="absolute bottom-0 left-0 w-10 h-0.5 bg-primaryLight mt-2"></span>
                    </h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        @forelse ($quickLinks as $link)
                            @php
                                $url = $link->link
                                    ? $link->link->url
                                    : ($link->post
                                        ? url('/' . $link->post->post->slug)
                                        : '#');
                            @endphp
                            <li>
                                <a href="{{ $url }}"
                                    class="hover:text-primaryLight transition flex items-center gap-2">
                                    <i class="fas fa-chevron-right text-xs text-primaryLight"></i>
                                    {{ $link->label }}
                                </a>
                            </li>
                        @empty
                            <li class="text-gray-500">Belum ada data</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Kolom 3: Kontak -->
                <div>
                    <h4 class="font-semibold text-lg mb-4 relative">
                        Kontak
                        <span class="absolute bottom-0 left-0 w-10 h-0.5 bg-primaryLight mt-2"></span>
                    </h4>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        @if ($yayasan && $yayasan->alamat)
                            <li class="flex items-start gap-3">
                                <i class="fas fa-map-marker-alt text-primaryLight mt-1"></i>
                                <span>{{ $yayasan->alamat }}</span>
                            </li>
                        @endif
                        @if ($yayasan && $yayasan->telepon)
                            <li class="flex items-center gap-3">
                                <i class="fas fa-phone text-primaryLight"></i>
                                <span>{{ $yayasan->telepon }}</span>
                            </li>
                        @endif
                        @if ($yayasan && $yayasan->whatsapp)
                            <li class="flex items-center gap-3">
                                <i class="fab fa-whatsapp text-primaryLight"></i>
                                <span>{{ $yayasan->whatsapp }}</span>
                            </li>
                        @endif
                        @if ($yayasan && $yayasan->email)
                            <li class="flex items-center gap-3">
                                <i class="fas fa-envelope text-primaryLight"></i>
                                <a href="mailto:{{ $yayasan->email }}" class="hover:text-primaryLight transition">
                                    {{ $yayasan->email }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Kolom 4: Media Sosial & Google Maps -->
                <div>
                    <h4 class="font-semibold text-lg mb-4 relative">
                        Media Sosial
                        <span class="absolute bottom-0 left-0 w-10 h-0.5 bg-primaryLight mt-2"></span>
                    </h4>
                    <div class="flex space-x-3 mb-4">
                        @if ($yayasan && $yayasan->facebook)
                            <a href="{{ $yayasan->facebook }}" target="_blank"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-primaryLight hover:text-white transition group">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif
                        @if ($yayasan && $yayasan->instagram)
                            <a href="{{ $yayasan->instagram }}" target="_blank"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-primaryLight hover:text-white transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif
                        @if ($yayasan && $yayasan->youtube)
                            <a href="{{ $yayasan->youtube }}" target="_blank"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-primaryLight hover:text-white transition">
                                <i class="fab fa-youtube"></i>
                            </a>
                        @endif
                        @if ($yayasan && $yayasan->twitter)
                            <a href="{{ $yayasan->twitter }}" target="_blank"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-primaryLight hover:text-white transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif
                    </div>

                    <!-- Google Maps -->
                    @if ($yayasan && $yayasan->google_maps)
                        <div class="mt-4 overflow-hidden rounded-lg">
                            {!! $yayasan->google_maps !!}
                        </div>
                    @else
                        <div class="bg-gray-800 rounded-lg p-3 text-center text-gray-500 text-xs">
                            <i class="fas fa-map-marked-alt"></i> Link Google Maps belum tersedia
                        </div>
                    @endif
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-10 pt-6 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Pondok Pesantren Roudlotut Tullab. All rights reserved.
            </div>
        </div>
    </footer>
    <script>
        const darkModeToggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;
        const icon = document.getElementById('darkModeIcon');

        if (localStorage.getItem('theme') === 'dark') {
            html.classList.add('dark');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        }

        darkModeToggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            if (html.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                localStorage.setItem('theme', 'light');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        });

        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        menuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>

</html>
