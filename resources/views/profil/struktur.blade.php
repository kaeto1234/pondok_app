@extends('layouts.app')

@section('title', 'Struktur Organisasi - Pondok Pesantren Roudlotut Tullab')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-[#166534]">Struktur Organisasi</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-2">Struktur Organisasi</h1>
            <p class="text-gray-500">Susunan kepengurusan Pondok Pesantren Roudlotut Tullab</p>
        </div>

        <!-- Bagan (placeholder) -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-8 mb-8 text-center">
            <p class="text-gray-400">[ Bagan Struktur Organisasi ]</p>
        </div>

        <!-- 1. Pengasuh (CENTER) -->
        <div class="text-center mb-8">
            <div class="inline-block bg-gray-100 dark:bg-gray-800 rounded-xl p-6 w-full max-w-sm">
                <div class="flex justify-center mb-3">
                    <div class="w-24 h-24 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-4xl text-gray-500"></i>
                    </div>
                </div>
                <div class="text-sm text-[#166534] font-semibold mb-1">Pengasuh</div>
                <div class="text-lg font-bold text-gray-800 dark:text-white">KH. Ahmad Maulana</div>
            </div>
        </div>

        <!-- 2. Kepala Pondok (CENTER) -->
        <div class="text-center mb-8">
            <div class="inline-block bg-gray-100 dark:bg-gray-800 rounded-xl p-6 w-full max-w-sm">
                <div class="flex justify-center mb-3">
                    <div class="w-24 h-24 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-4xl text-gray-500"></i>
                    </div>
                </div>
                <div class="text-sm text-[#166534] font-semibold mb-1">Kepala Pondok</div>
                <div class="text-lg font-bold text-gray-800 dark:text-white">Dr. KH. Muhammad Hasan, M.Ag</div>
            </div>
        </div>

        <!-- 3. Sekretaris (grid) -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-5 mb-4">
            <h3 class="text-center text-md font-semibold text-[#166534] mb-4">Sekretaris</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Sekretaris 1 -->
                <div class="text-center">
                    <div class="flex justify-center mb-2">
                        <div class="w-20 h-20 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-3xl text-gray-500"></i>
                        </div>
                    </div>
                    <div class="text-sm font-semibold text-gray-800 dark:text-white">Ustadz Ali Imron</div>
                    <div class="text-xs text-gray-500">Sekretaris Umum</div>
                </div>
                <!-- Sekretaris 2 -->
                <div class="text-center">
                    <div class="flex justify-center mb-2">
                        <div class="w-20 h-20 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-3xl text-gray-500"></i>
                        </div>
                    </div>
                    <div class="text-sm font-semibold text-gray-800 dark:text-white">Ustadz Zainal Abidin</div>
                    <div class="text-xs text-gray-500">Wakil Sekretaris</div>
                </div>
                <!-- Sekretaris 3 -->
                <div class="text-center">
                    <div class="flex justify-center mb-2">
                        <div class="w-20 h-20 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-3xl text-gray-500"></i>
                        </div>
                    </div>
                    <div class="text-sm font-semibold text-gray-800 dark:text-white">Ustadz Fulan</div>
                    <div class="text-xs text-gray-500">Sekretaris Bidang</div>
                </div>
            </div>
        </div>

        <!-- 4. Bendahara (grid) -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-5 mb-4">
            <h3 class="text-center text-md font-semibold text-[#166534] mb-4">Bendahara</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Bendahara 1 -->
                <div class="text-center">
                    <div class="flex justify-center mb-2">
                        <div class="w-20 h-20 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-3xl text-gray-500"></i>
                        </div>
                    </div>
                    <div class="text-sm font-semibold text-gray-800 dark:text-white">Ustadzah Fatimah</div>
                    <div class="text-xs text-gray-500">Bendahara Umum</div>
                </div>
                <!-- Bendahara 2 -->
                <div class="text-center">
                    <div class="flex justify-center mb-2">
                        <div class="w-20 h-20 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-3xl text-gray-500"></i>
                        </div>
                    </div>
                    <div class="text-sm font-semibold text-gray-800 dark:text-white">Ustadz Hasan</div>
                    <div class="text-xs text-gray-500">Wakil Bendahara</div>
                </div>
            </div>
        </div>

        <!-- 5. Dewan Pengajar (CENTER) -->
        <div class="text-center mt-6">
            <div class="inline-block bg-gray-100 dark:bg-gray-800 rounded-xl p-6 w-full max-w-sm">
                <div class="flex justify-center mb-3">
                    <div class="w-24 h-24 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <i class="fas fa-chalkboard-user text-4xl text-gray-500"></i>
                    </div>
                </div>
                <div class="text-sm text-[#166534] font-semibold mb-1">Dewan Pengajar</div>
                <div class="text-lg font-bold text-gray-800 dark:text-white">50+ Asatidz Profesional</div>
                <div class="text-xs text-gray-500 mt-1">Tahfidz, Kitab Kuning, Bahasa Arab, Fiqih</div>
            </div>
        </div>

    </div>
</div>
@endsection