<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Custom warna biru tua */
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

        .hover\\:bg-navy-hover:hover {
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

    <!-- Navbar Admin -->
    <nav class="bg-[#1e3a5f] text-white px-6 py-4 flex justify-between items-center shadow-lg">
        <div class="flex items-center space-x-3">
            <i class="fas fa-mosque text-2xl"></i>
            <div>
                <span class="font-bold text-lg">Admin Panel</span>
                <p class="text-xs text-white/70">Ponpes Roudlotut Tullab</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-sm text-white/80">
                <i class="fas fa-user mr-1"></i> Admin
            </span>
            <a href="#" class="text-white/80 hover:text-white transition">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </nav>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-[#0f2b4a] text-white min-h-screen shadow-lg">
            <div class="p-5">
                <div class="mb-8">
                    <h2 class="text-sm uppercase tracking-wider text-white/50 mb-2">Menu Utama</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                                <i class="fas fa-tachometer-alt w-5"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="mb-8">
                    <h2 class="text-sm uppercase tracking-wider text-white/50 mb-2">Konten</h2>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('admin.categories.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                                <i class="fas fa-tags w-5"></i>
                                <span>Kategori</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.posts.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                                <i class="fas fa-newspaper w-5"></i>
                                <span>Semua Post</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.menus.index') }}"
                                class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                                <i class="fas fa-bars w-5"></i>
                                <span>Menu Navigasi</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="flex-1 p-6 bg-gray-100">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>

</html>
