@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500">Selamat datang di panel admin Pondok Pesantren Roudlotut Tullab</p>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Post -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Post</p>
                    <p class="text-2xl font-bold text-[#1e3a5f]">{{ $totalPosts }}</p>
                </div>
                <div class="w-12 h-12 bg-[#1e3a5f]/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-newspaper text-[#1e3a5f] text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Kategori</p>
                    <p class="text-2xl font-bold text-[#1e3a5f]">{{ $totalCategories }}</p>
                </div>
                <div class="w-12 h-12 bg-[#1e3a5f]/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-tags text-[#1e3a5f] text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Menu -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Menu</p>
                    <p class="text-2xl font-bold text-[#1e3a5f]">{{ $totalMenus }}</p>
                </div>
                <div class="w-12 h-12 bg-[#1e3a5f]/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-bars text-[#1e3a5f] text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Post per Kategori -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Post per Kategori</p>
                    <p class="text-xs text-gray-600">
                        📄 Profil: {{ $totalProfil }} |
                        📞 Kontak: {{ $totalKontak }} |
                        🎓 Akademik: {{ $totalAkademik }} |
                        🏠 Fasilitas: {{ $totalFasilitas }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-[#1e3a5f]/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-chart-simple text-[#1e3a5f] text-xl"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- INFO TAMBAHAN: 3 KOLOM --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">

        {{-- Post Terbaru --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-newspaper text-navy-primary mr-2"></i> Post Terbaru
            </h3>
            @php
                $latestPosts = \App\Models\Post::orderBy('created_at', 'desc')->limit(5)->get();
            @endphp
            @if ($latestPosts->count() > 0)
                <ul class="space-y-2">
                    @foreach ($latestPosts as $post)
                        <li class="text-sm text-gray-600 border-b pb-2 last:border-0">
                            <span class="text-xs bg-gray-100 px-2 py-0.5 rounded">{{ $post->post_type }}</span>
                            <span class="font-medium">{{ $post->title }}</span>
                            <span class="text-xs text-gray-400 block mt-1">
                                <i class="fas fa-clock mr-1"></i>{{ $post->created_at->diffForHumans() }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400 text-sm">Belum ada post</p>
            @endif
        </div>

        {{-- Menu Navigasi --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-bars text-navy-primary mr-2"></i> Menu Navigasi
            </h3>
            @php
                $menus = \App\Models\Menu::whereNull('parent_id')->orderBy('order')->limit(5)->get();
            @endphp
            @if ($menus->count() > 0)
                <ul class="space-y-2">
                    @foreach ($menus as $menu)
                        <li class="text-sm text-gray-600 border-b pb-2 last:border-0">
                            • <span class="font-medium">{{ $menu->label }}</span>
                            @if ($menu->children->count())
                                <span class="text-xs text-gray-400">({{ $menu->children->count() }} sub menu)</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400 text-sm">Belum ada menu</p>
            @endif
        </div>

        {{-- HISTORI AKTIVITAS --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-history text-navy-primary mr-2"></i> Aktivitas Terbaru
            </h3>
            @if ($activityLogs->count() > 0)
                <ul class="space-y-3 max-h-80 overflow-y-auto">
                    @foreach ($activityLogs as $log)
                        <li class="text-sm border-b pb-2 last:border-0">
                            <div class="flex items-start gap-2">
                                <div
                                    class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center
                                    @if ($log['action'] == 'created') bg-green-100 text-green-600
                                    @elseif ($log['action'] == 'updated') bg-yellow-100 text-yellow-600
                                    @else bg-blue-100 text-blue-600 @endif">
                                    <i
                                        class="fas
                                        @if ($log['action'] == 'created') fa-plus
                                        @elseif ($log['action'] == 'updated') fa-pen
                                        @else fa-info @endif text-xs"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-gray-700 text-xs leading-snug">
                                        <span class="font-semibold">{{ $log['model'] }}:</span>
                                        {{ $log['name'] }}
                                    </p>
                                    <p class="text-gray-400 text-xs mt-0.5">
                                        <span class="capitalize">{{ $log['action'] }}</span> •
                                        <i class="fas fa-clock mx-1"></i>{{ $log['waktu']->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400 text-sm">Belum ada aktivitas</p>
            @endif
        </div>

    </div>
@endsection
