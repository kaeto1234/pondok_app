@extends('layouts.app')

@section('title', 'Program Diniyah - Pondok Pesantren Roudlotut Tullab')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/akademik') }}" class="hover:text-[#166534]">Akademik</a>
            <span class="mx-2">/</span>
            <span class="text-[#166534]">Program Diniyah</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-2">Program Diniyah</h1>
            <p class="text-gray-500">Tingkatan pendidikan diniyah di Pondok Pesantren Roudlotut Tullab</p>
        </div>

        <!-- Diniyah Ula -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-6 mb-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-[#166534] rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold">1</span>
                </div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Diniyah Ula</h2>
            </div>
            <p class="text-gray-600 dark:text-gray-300 mb-3">
                Tingkat dasar (setara SD/MI). Santri mempelajari dasar-dasar ilmu agama Islam.
            </p>
            <div class="flex flex-wrap gap-2">
                <span class="bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs px-3 py-1 rounded-full">Tahsin Al-Qur'an</span>
                <span class="bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs px-3 py-1 rounded-full">Tauhid Dasar</span>
                <span class="bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs px-3 py-1 rounded-full">Fiqih Dasar</span>
                <span class="bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs px-3 py-1 rounded-full">Baca Tulis Qur'an</span>
            </div>
        </div>

        <!-- Diniyah Wustha -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-6 mb-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-[#166534] rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold">2</span>
                </div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white">Diniyah Wustha</h2>
            </div>
            <p class="text-gray-600 dark:text-gray-300 mb-3">
                Tingkat menengah (setara SMP/MTs). Santri memperdalam ilmu agama dan mulai mempelajari kitab kuning.
            </p>
            <div class="flex flex-wrap gap-2">
                <span class="bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs px-3 py-1 rounded-full">Nahwu</span>
                <span class="bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs px-3 py-1 rounded-full">Shorof</span>
                <span class="bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs px-3 py-1 rounded-full">Tafsir Jalalain</span>
                <span class="bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs px-3 py-1 rounded-full">Hadits</span>
                <span class="bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs px-3 py-1 rounded-full">Fiqih</span>
            </div>
        </div>

        <!-- Program Unggulan -->
        <div class="bg-[#166534] text-white rounded-xl p-6">
            <h2 class="text-xl font-bold mb-3">Program Unggulan</h2>
            <p class="text-white/90 mb-4">
                Selain program reguler, pondok juga memiliki program unggulan yang dapat dipilih oleh santri.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="bg-white/10 rounded-lg p-3 text-center">
                    <i class="fas fa-quran text-2xl mb-2 block"></i>
                    <span class="text-sm font-semibold">Tahfidz Al-Qur'an</span>
                </div>
                <div class="bg-white/10 rounded-lg p-3 text-center">
                    <i class="fas fa-language text-2xl mb-2 block"></i>
                    <span class="text-sm font-semibold">Bahasa Arab</span>
                </div>
                <div class="bg-white/10 rounded-lg p-3 text-center">
                    <i class="fas fa-chalkboard-user text-2xl mb-2 block"></i>
                    <span class="text-sm font-semibold">Kajian Kitab Kuning</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection