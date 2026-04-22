@extends('layouts.app')

@section('title', 'Fasilitas - Pondok Pesantren Roudlotut Tullab')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-[#166534]">Fasilitas</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-2">Fasilitas Pondok</h1>
            <p class="text-gray-500">Sarana dan prasarana yang tersedia di Pondok Pesantren Roudlotut Tullab</p>
        </div>

        <!-- Grid Fasilitas -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Fasilitas 1: Masjid -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-40 bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-mosque text-5xl text-gray-500"></i>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Masjid</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Masjid utama pondok dengan kapasitas 1000 jamaah, dilengkapi AC dan sound system.</p>
                </div>
            </div>

            <!-- Fasilitas 2: Asrama -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-40 bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-bed text-5xl text-gray-500"></i>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Asrama</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Asrama santri putra dan putri dengan fasilitas lengkap dan nyaman.</p>
                </div>
            </div>

            <!-- Fasilitas 3: Perpustakaan -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-40 bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-book text-5xl text-gray-500"></i>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Perpustakaan</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Koleksi 5000+ buku agama, umum, dan kitab kuning.</p>
                </div>
            </div>

            <!-- Fasilitas 4: Laboratorium -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-40 bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-flask text-5xl text-gray-500"></i>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Laboratorium</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Lab komputer dan bahasa untuk menunjang pembelajaran.</p>
                </div>
            </div>

            <!-- Fasilitas 5: Kantin & Dapur Umum -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-40 bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-utensils text-5xl text-gray-500"></i>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Kantin & Dapur Umum</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Menyediakan makanan sehat dan bergizi untuk santri.</p>
                </div>
            </div>

            <!-- Fasilitas 6: Klinik Kesehatan -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-40 bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-hospital-user text-5xl text-gray-500"></i>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Klinik Kesehatan</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Pelayanan kesehatan 24 jam untuk santri.</p>
                </div>
            </div>

            <!-- Fasilitas 7: Lapangan Olahraga -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-40 bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-futbol text-5xl text-gray-500"></i>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Lapangan Olahraga</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Lapangan futsal, basket, dan voli untuk kegiatan santri.</p>
                </div>
            </div>

            <!-- Fasilitas 8: Ruang Kelas -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-40 bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-chalkboard-user text-5xl text-gray-500"></i>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Ruang Kelas</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Ruang kelas nyaman dengan kapasitas 30 santri per kelas.</p>
                </div>
            </div>

            <!-- Fasilitas 9: Aula -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="h-40 bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-building text-5xl text-gray-500"></i>
                </div>
                <div class="p-5">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Aula</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Aula serbaguna untuk acara dan kegiatan besar.</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection