@extends('layouts.app')

@section('title', 'Kontak - Pondok Pesantren Roudlotut Tullab')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-[#166534]">Kontak</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-2">Hubungi Kami</h1>
            <p class="text-gray-500">Silakan hubungi kami melalui informasi di bawah ini</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Informasi Kontak -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Informasi Kontak</h2>
                
                <div class="space-y-4">
                    <!-- Alamat -->
                    <div class="flex gap-3">
                        <div class="w-10 h-10 bg-[#166534]/10 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-[#166534]"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-white">Alamat</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">Jl. Pesantren No. 1, Desa Sukamaju, Kec. Ciawi, Kab. Bogor, Jawa Barat 16720</p>
                        </div>
                    </div>

                    <!-- Telepon -->
                    <div class="flex gap-3">
                        <div class="w-10 h-10 bg-[#166534]/10 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone-alt text-[#166534]"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-white">Telepon</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">(021) 1234567</p>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="flex gap-3">
                        <div class="w-10 h-10 bg-[#166534]/10 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fab fa-whatsapp text-[#166534]"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-white">WhatsApp</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">0812-3456-7890</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex gap-3">
                        <div class="w-10 h-10 bg-[#166534]/10 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-[#166534]"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 dark:text-white">Email</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">info@ponpes.sch.id</p>
                        </div>
                    </div>
                </div>

                <!-- Media Sosial -->
                <div class="mt-8">
                    <h3 class="font-semibold text-gray-800 dark:text-white mb-3">Media Sosial</h3>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-[#166534] hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-[#166534] hover:text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-[#166534] hover:text-white transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 hover:bg-[#166534] hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Google Maps -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Lokasi Kami</h2>
                <div class="w-full h-80 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-map text-4xl text-gray-400 mb-2"></i>
                        <p class="text-gray-500 text-sm">[Google Maps akan tampil di sini]</p>
                        <p class="text-gray-400 text-xs mt-2">Jl. Pesantren No. 1, Bogor</p>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <a href="https://maps.google.com/?q=Jl.+Pesantren+No.+1+Bogor" target="_blank" class="text-[#166534] text-sm hover:underline">
                        <i class="fas fa-external-link-alt mr-1"></i> Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection