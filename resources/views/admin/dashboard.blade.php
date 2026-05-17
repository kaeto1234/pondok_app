@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-500">Selamat datang di panel admin Pondok Pesantren Roudlotut Tullab</p>
</div>

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
    
    <!-- Total Post by Kategori (Ringkasan) -->
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

<!-- Info tambahan -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-gray-800 mb-2">📝 Post Terbaru</h3>
        @php
            $latestPosts = App\Models\Post::orderBy('created_at', 'desc')->limit(5)->get();
        @endphp
        <ul class="space-y-2">
            @foreach($latestPosts as $post)
            <li class="text-sm text-gray-600">
                <span class="text-xs bg-gray-100 px-2 py-0.5 rounded">{{ $post->post_type }}</span>
                {{ $post->title }}
                <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
            </li>
            @endforeach
        </ul>
        @if($latestPosts->isEmpty())
        <p class="text-gray-400 text-sm">Belum ada post</p>
        @endif
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-gray-800 mb-2">📌 Menu Navigasi</h3>
        @php
            $menus = App\Models\Menu::whereNull('parent_id')->orderBy('order')->limit(5)->get();
        @endphp
        <ul class="space-y-2">
            @foreach($menus as $menu)
            <li class="text-sm text-gray-600">
                • {{ $menu->label }}
                @if($menu->children->count())
                    <span class="text-xs text-gray-400">({{ $menu->children->count() }} sub menu)</span>
                @endif
            </li>
            @endforeach
        </ul>
        @if($menus->isEmpty())
        <p class="text-gray-400 text-sm">Belum ada menu</p>
        @endif
    </div>
</div>
@endsection