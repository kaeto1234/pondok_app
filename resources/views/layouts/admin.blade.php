<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Ponpes Roudlotut Tullab</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
    </style>

    @stack('styles')
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav
        class="bg-[#1e3a5f] text-white px-6 py-4 flex justify-between items-center shadow-lg fixed top-0 left-0 right-0 z-50">
        <div class="flex items-center space-x-3">
            <i class="fas fa-mosque text-2xl"></i>
            <div>
                <span class="font-bold text-lg">
                    @if (session('user_role') == 'admin')
                        Admin Panel
                    @elseif(session('user_role') == 'guru')
                        Portal Guru
                    @else
                        Portal Wali Santri
                    @endif
                </span>
                <p class="text-xs text-white/70">Ponpes Roudlotut Tullab</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-sm text-white/80">
                <i class="fas fa-user mr-1"></i> {{ session('user_name') }}
            </span>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-white/80 hover:text-white transition" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </nav>

    <div class="flex min-h-screen pt-16">
        <!-- Sidebar -->
        <div class="w-64 bg-[#0f2b4a] text-white min-h-screen shadow-lg fixed top-16 left-0 bottom-0 overflow-y-auto">
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
                        </ul>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-xs uppercase tracking-wider text-white/50 mb-2">Konten</h2>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('admin.posts.index') }}"
                                    class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition {{ request()->routeIs('admin.posts.*') ? 'bg-[#2a4a7a]' : '' }}">
                                    <i class="fas fa-newspaper w-5"></i>
                                    <span>Artikel & Halaman</span>
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
                        </ul>
                    </div>
                @endif

            </div>
        </div>

        <!-- Content -->
        <div class="flex-1 ml-64 p-6 bg-gray-100">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>

</html>
