@extends('layouts.app')

@section('title', 'Mata Pelajaran - Pondok Pesantren Roudlotut Tullab')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/akademik') }}" class="hover:text-[#166534]">Akademik</a>
            <span class="mx-2">/</span>
            <span class="text-[#166534]">Mata Pelajaran</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-2">Mata Pelajaran</h1>
            <p class="text-gray-500">Daftar mata pelajaran dan kitab yang dipelajari</p>
        </div>

        <!-- Diniyah Ula -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-5 mb-6">
            <h2 class="text-lg font-bold text-[#166534] mb-3">📖 Diniyah Ula</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                <div class="bg-white dark:bg-gray-700 rounded-lg p-2 text-center">
                    <div class="font-semibold text-gray-800 dark:text-white">Tauhid</div>
                    <div class="text-xs text-gray-500">Aqidatul Awam</div>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg p-2 text-center">
                    <div class="font-semibold text-gray-800 dark:text-white">Fiqih</div>
                    <div class="text-xs text-gray-500">Safinatun Najah</div>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg p-2 text-center">
                    <div class="font-semibold text-gray-800 dark:text-white">Nahwu</div>
                    <div class="text-xs text-gray-500">Jurumiyah</div>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg p-2 text-center">
                    <div class="font-semibold text-gray-800 dark:text-white">Al-Qur'an</div>
                    <div class="text-xs text-gray-500">Tahsin & Tahfidz</div>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg p-2 text-center">
                    <div class="font-semibold text-gray-800 dark:text-white">Akhlak</div>
                    <div class="text-xs text-gray-500">Ta'lim Muta'allim</div>
                </div>
            </div>
        </div>

        <!-- Diniyah Wustha -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-5 mb-6">
            <h2 class="text-lg font-bold text-[#166534] mb-3">📚 Diniyah Wustha</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                <div class="bg-white dark:bg-gray-700 rounded-lg p-2 text-center">
                    <div class="font-semibold text-gray-800 dark:text-white">Tafsir</div>
                    <div class="text-xs text-gray-500">Tafsir Jalalain</div>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg p-2 text-center">
                    <div class="font-semibold text-gray-800 dark:text-white">Hadits</div>
                    <div class="text-xs text-gray-500">Bulughul Maram</div>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg p-2 text-center">
                    <div class="font-semibold text-gray-800 dark:text-white">Fiqih</div>
                    <div class="text-xs text-gray-500">Fathul Qorib</div>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg p-2 text-center">
                    <div class="font-semibold text-gray-800 dark:text-white">Nahwu</div>
                    <div class="text-xs text-gray-500">Imrithi</div>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg p-2 text-center">
                    <div class="font-semibold text-gray-800 dark:text-white">Shorof</div>
                    <div class="text-xs text-gray-500">Amtsilatut Tashrifiyah</div>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-lg p-2 text-center">
                    <div class="font-semibold text-gray-800 dark:text-white">Ushul Fiqih</div>
                    <div class="text-xs text-gray-500">Waraqat</div>
                </div>
            </div>
        </div>

        <!-- Keterangan -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-4 text-center text-sm text-gray-500">
            <i class="fas fa-info-circle mr-1"></i>
            Kurikulum dapat berubah sesuai dengan perkembangan dan kebutuhan pondok.
        </div>
    </div>
</div>
@endsection