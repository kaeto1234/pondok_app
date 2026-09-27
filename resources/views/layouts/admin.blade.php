<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Ponpes Roudlotut Tullab</title>
    @if (isset($yayasan) && $yayasan?->logo)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $yayasan->logo) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('assets/logo_ponpes.png') }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        :root {
            --navy-primary: #1e3a5f;
            --navy-hover: #2a4a7a;
            --navy-sidebar: #0f2b4a;
        }

        .bg-navy-primary {
            background-color: #1e3a5f;
        }

        .bg-navy-sidebar {
            background-color: #0f2b4a;
        }

        .hover\:bg-navy-hover:hover {
            background-color: #2a4a7a;
        }

        .text-navy-primary {
            color: #1e3a5f;
        }

        .border-navy-primary {
            border-color: #1e3a5f;
        }

        /* Sidebar responsive transition */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }

        /* Overlay untuk mobile sidebar */
        .sidebar-overlay {
            transition: opacity 0.3s ease-in-out;
        }

        /* Scrollbar styling untuk sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-100">

    <!-- ==================== NAVBAR ==================== -->
    <nav class="bg-[#1e3a5f] text-white shadow-lg fixed top-0 left-0 right-0 z-50">
        <div class="px-4 md:px-6 py-3 flex justify-between items-center">

            <!-- KIRI: Hamburger + Logo -->
            <div class="flex items-center space-x-3">
                <!-- Hamburger (mobile only) -->
                <button id="sidebarToggle"
                    class="lg:hidden text-white text-xl focus:outline-none hover:bg-white/10 p-2 rounded-lg transition">
                    <i class="fas fa-bars"></i>
                </button>

                <i class="fas fa-mosque text-2xl hidden sm:inline"></i>
                <div class="min-w-0">
                    <span class="font-bold text-sm sm:text-lg block truncate">
                        @if (session('user_role') == 'admin')
                            Admin Panel
                        @elseif(session('user_role') == 'guru')
                            Portal Guru
                        @else
                            Portal Wali Santri
                        @endif
                    </span>
                    <p class="text-xs text-white/70 hidden sm:block">Ponpes Roudlotut Tullab</p>
                </div>
            </div>

            <!-- KANAN: User + Logout -->
            <div class="flex items-center space-x-2 sm:space-x-4">
                <span class="text-sm text-white/80 hidden md:inline">
                    <i class="fas fa-user mr-1"></i> {{ session('user_name') }}
                </span>
                <span class="text-sm text-white/80 md:hidden">
                    <i class="fas fa-user"></i>
                </span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-white/80 hover:text-white transition p-2 rounded-lg hover:bg-white/10"
                        title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- ==================== SIDEBAR OVERLAY (mobile) ==================== -->
    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black/50 z-40 hidden lg:hidden opacity-0">
    </div>

    <!-- ==================== SIDEBAR ==================== -->
    <aside id="sidebar"
        class="sidebar-transition fixed top-0 lg:top-16 left-0 bottom-0 w-64 bg-[#0f2b4a] text-white shadow-lg z-50 lg:z-40 overflow-y-auto sidebar-scroll -translate-x-full lg:translate-x-0 pt-16 lg:pt-0">

        <div class="p-5">

            {{-- ===== MENU ADMIN ===== --}}
            @if (session('user_role') == 'admin')
                <div class="mb-6">
                    <h2 class="text-xs uppercase tracking-wider text-white/50 mb-2">Menu Utama</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-tachometer-alt w-5"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mb-6">
                    <h2 class="text-xs uppercase tracking-wider text-white/50 mb-2">PPDB</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.ppdb.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.ppdb.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-user-plus w-5"></i>
                                <span>Pendaftaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.tahun-ajaran.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.tahun-ajaran.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-calendar-alt w-5"></i>
                                <span>Tahun Ajaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.jenis-berkas.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.jenis-berkas.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-file-alt w-5"></i>
                                <span>Jenis Berkas</span>
                            </a>
                        </li>
                    </ul>

                    <p class="text-xs uppercase tracking-wider text-white/50 mb-2 mt-4">Akademik</p>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.guru.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.guru.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-chalkboard-teacher w-5"></i>
                                <span>Manajemen Guru</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.tingkat-diniyah.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.tingkat-diniyah.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-layer-group w-5"></i>
                                <span>Tingkat Diniyah</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.mata-pelajaran.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.mata-pelajaran.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-book w-5"></i>
                                <span>Mata Pelajaran</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.kurikulum.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.kurikulum.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-sitemap w-5"></i>
                                <span>Kurikulum</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.jenis-ujian.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.jenis-ujian.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-star w-5"></i>
                                <span>Jenis Ujian</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.jadwal-mengajar.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.jadwal-mengajar.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-calendar-check w-5"></i>
                                <span>Jadwal Mengajar</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.kitab.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.kitab.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-book-open w-5"></i>
                                <span>Kitab</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.santri.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.santri.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-user-graduate w-5"></i>
                                <span>Manajemen Santri</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mb-6">
                    <h2 class="text-xs uppercase tracking-wider text-white/50 mb-2">Konten</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.posts.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.posts.index') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-newspaper w-5"></i>
                                <span>Artikel & Berita</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.posts.pages') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.posts.pages') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-file-alt w-5"></i>
                                <span>Halaman Statis</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.categories.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-tags w-5"></i>
                                <span>Kategori</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.menus.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.menus.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-bars w-5"></i>
                                <span>Menu Navigasi</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mb-6">
                    <h2 class="text-xs uppercase tracking-wider text-white/50 mb-2">Pengaturan</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.yayasan.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.yayasan.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-building w-5"></i>
                                <span>Profil Yayasan</span>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- ===== MENU GURU ===== --}}
            @elseif(session('user_role') == 'guru')
                <div class="mb-6">
                    <h2 class="text-xs uppercase tracking-wider text-white/50 mb-2">Menu Utama</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('guru.dashboard') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('guru.dashboard') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-tachometer-alt w-5"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('guru.absensi.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('guru.absensi.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-clipboard-check w-5"></i>
                                <span>Absensi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('guru.nilai.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('guru.nilai.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-star w-5"></i>
                                <span>Nilai</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('guru.santri.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('guru.santri.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-users w-5"></i>
                                <span>Daftar Santri</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('guru.materi.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('guru.materi.*') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-book-open w-5"></i>
                                <span>Materi</span>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- ===== MENU WALI ===== --}}
            @else
                <div class="mb-6">
                    <h2 class="text-xs uppercase tracking-wider text-white/50 mb-2">Menu Utama</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('wali.dashboard') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('wali.dashboard') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-tachometer-alt w-5"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('wali.santri.nilai') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('wali.santri.nilai') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-star w-5"></i>
                                <span>Nilai</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('wali.santri.absensi') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('wali.santri.absensi') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-clipboard-check w-5"></i>
                                <span>Absensi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('wali.santri.materi') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('wali.santri.materi') ? 'bg-[#2a4a7a]' : '' }}">
                                <i class="fas fa-book w-5"></i>
                                <span>Materi</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif

        </div>
    </aside>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="pt-16 lg:pl-64 min-h-screen transition-all duration-300">
        <div class="p-4 md:p-6">
            @yield('content')
        </div>
    </main>

    <!-- ==================== SCRIPT ==================== -->
    <script>
        // Toggle Sidebar
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
            setTimeout(() => {
                sidebarOverlay.classList.add('opacity-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.remove('opacity-100');
            setTimeout(() => {
                sidebarOverlay.classList.add('hidden');
            }, 300);
            document.body.style.overflow = '';
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                if (sidebar.classList.contains('-translate-x-full')) {
                    openSidebar();
                } else {
                    closeSidebar();
                }
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebar);
        }

        // Tutup sidebar saat klik link (mobile)
        sidebar.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    closeSidebar();
                }
            });
        });

        // Handle resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                sidebarOverlay.classList.remove('opacity-100');
                document.body.style.overflow = '';
            } else {
                if (!sidebarOverlay.classList.contains('hidden')) {
                    sidebar.classList.remove('-translate-x-full');
                } else {
                    sidebar.classList.add('-translate-x-full');
                }
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
