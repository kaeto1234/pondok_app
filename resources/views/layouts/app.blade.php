<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pondok Pesantren Roudlotut Tullab')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Custom CSS untuk mengatasi Tailwind CDN + dark mode -->
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
        /* Custom animations */
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
                    <img src="{{ asset('asset/logo_ponpes.png') }}" alt="Logo Ponpes Roudlotut Tullab" class="h-20 w-auto">
                    <span class="text-white font-bold text-xl whitespace-nowrap">Roudlotut Tullab</span>
                </div>

                <!-- DESKTOP MENU (dengan dropdown) -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ url('/') }}"
                        class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm">Beranda</a>

                    <!-- Dropdown Profil -->
                    <div class="relative group">
                        <a href="#"
                            class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm inline-flex items-center">
                            Profil
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <div
                            class="absolute left-0 mt-1 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                <a href="{{ url('/profil/sejarah') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Sejarah</a>
                                <a href="{{ url('/profil/visi-misi') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Visi
                                    & Misi</a>
                                <a href="{{ url('/profil/struktur') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Struktur
                                    Organisasi</a>
                                <a href="{{ url('/profil/sambutan') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Sambutan
                                    Pimpinan</a>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Akademik -->
                    <div class="relative group">
                        <a href="#"
                            class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm inline-flex items-center">
                            Akademik
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <div
                            class="absolute left-0 mt-1 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="py-2">
                                <a href="{{ url('/akademik/program') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Program
                                    Diniyah</a>
                                <a href="{{ url('/akademik/mapel') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">Mata
                                    Pelajaran</a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ url('/fasilitas') }}"
                        class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm">Fasilitas</a>
                    <a href="{{ url('/berita') }}"
                        class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm">Berita</a>
                    <a href="{{ url('/kontak') }}"
                        class="text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm">Kontak</a>
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

                <!-- Mobile Dropdown Profil -->
                <div x-data="{ open: false }" class="w-full">
                    <button @click="open = !open"
                        class="w-full text-left text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition flex justify-between items-center">
                        Profil
                        <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div x-show="open" class="ml-4 space-y-1" x-cloak>
                        <a href="{{ url('/profil/sejarah') }}"
                            class="block text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm">Sejarah</a>
                        <a href="{{ url('/profil/visi-misi') }}"
                            class="block text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm">Visi
                            & Misi</a>
                        <a href="{{ url('/profil/struktur') }}"
                            class="block text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm">Struktur
                            Organisasi</a>
                        <a href="{{ url('/profil/sambutan') }}"
                            class="block text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm">Sambutan
                            Pimpinan</a>
                    </div>
                </div>

                <a href="{{ url('/akademik') }}"
                    class="block text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition">Akademik</a>
                <a href="{{ url('/fasilitas') }}"
                    class="block text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition">Fasilitas</a>
                <a href="{{ url('/berita') }}"
                    class="block text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition">Berita</a>
                <a href="{{ url('/kontak') }}"
                    class="block text-white/80 hover:text-white hover:bg-white/10 px-3 py-2 rounded-lg transition">Kontak</a>
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
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-mosque text-2xl text-primaryLight"></i>
                        <span class="font-bold text-xl">Ponpes Roudlotut Tullab</span>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Mencetak generasi yang beriman, berilmu, dan berakhlak mulia.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="{{ url('/profil') }}" class="hover:text-primaryLight transition">Profil</a></li>
                        <li><a href="{{ url('/akademik') }}" class="hover:text-primaryLight transition">Akademik</a>
                        </li>
                        <li><a href="{{ url('/fasilitas') }}"
                                class="hover:text-primaryLight transition">Fasilitas</a></li>
                        <li><a href="{{ url('/berita') }}" class="hover:text-primaryLight transition">Berita</a></li>
                        <li><a href="{{ url('/kontak') }}" class="hover:text-primaryLight transition">Kontak</a></li>
                        <li><a href="{{ url('/ppdb') }}" class="hover:text-primaryLight transition">PPDB</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><i class="fas fa-map-marker-alt w-5 text-primaryLight"></i> Jl. Pesantren No. 1, Bogor</li>
                        <li><i class="fas fa-phone w-5 text-primaryLight"></i> (021) 1234567</li>
                        <li><i class="fab fa-whatsapp w-5 text-primaryLight"></i> 0812-3456-7890</li>
                        <li><i class="fas fa-envelope w-5 text-primaryLight"></i> info@ponpes.sch.id</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-lg mb-4">Media Sosial</h4>
                    <div class="flex space-x-4">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-primaryLight hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-primaryLight hover:text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-primaryLight hover:text-white transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-primaryLight hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Pondok Pesantren Roudlotut Tullab. All rights reserved.
            </div>
        </div>
    </footer>



    <!-- Scripts -->
    <script>
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const html = document.documentElement;
        const icon = document.getElementById('darkModeIcon');

        // Check localStorage for theme preference
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

        // Mobile Menu Toggle
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        menuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>

</html>
