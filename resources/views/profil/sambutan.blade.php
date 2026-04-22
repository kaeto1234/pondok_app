@extends('layouts.app')

@section('title', 'Sambutan Pimpinan - Pondok Pesantren Roudlotut Tullab')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-[#166534]">Sambutan Pimpinan</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-2">Sambutan Pimpinan</h1>
            <p class="text-gray-500">Kata sambutan dari Pengasuh Pondok Pesantren Roudlotut Tullab</p>
        </div>

        <!-- Foto dan Informasi Pimpinan -->
        <div class="text-center mb-8">
            <div class="inline-block">
                <div class="w-32 h-32 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-user-circle text-6xl text-gray-500"></i>
                </div>
                <div class="text-xl font-bold text-gray-800 dark:text-white">KH. Ahmad Maulana</div>
                <div class="text-sm text-[#166534] font-semibold">Pengasuh Pondok Pesantren</div>
            </div>
        </div>

        <!-- Kata Sambutan -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-6 md:p-8">
            <div class="mb-4">
                <i class="fas fa-quote-left text-2xl text-[#166534] opacity-50"></i>
            </div>
            
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                Assalamu'alaikum warahmatullahi wabarakatuh.
            </p>
            
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                Puji syukur kehadirat Allah SWT, atas segala rahmat dan karunia-Nya, Pondok Pesantren Roudlotut Tullab dapat terus berkembang dan memberikan kontribusi terbaik bagi pendidikan agama di Indonesia.
            </p>
            
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                Pondok Pesantren Roudlotut Tullab hadir sebagai lembaga pendidikan Islam yang berkomitmen untuk mencetak generasi yang beriman, berilmu, dan berakhlak mulia. Kami percaya bahwa dengan pendidikan yang berkualitas, santri dapat menjadi pribadi yang mandiri, berdaya saing, dan bermanfaat bagi masyarakat.
            </p>
            
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                Kami mengundang seluruh masyarakat untuk bergabung dan menjadi bagian dari keluarga besar Pondok Pesantren Roudlotut Tullab. Mari bersama-sama mencetak generasi yang beriman, berilmu, dan berakhlak mulia.
            </p>
            
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                Akhir kata, semoga Allah SWT senantiasa memberikan kemudahan dan keberkahan kepada kita semua dalam menuntut ilmu dan mengamalkannya.
            </p>
            
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mt-6">
                Wassalamu'alaikum warahmatullahi wabarakatuh.
            </p>
            
            <div class="mt-6 text-right">
                <div class="font-semibold text-gray-800 dark:text-white">KH. Ahmad Maulana</div>
                <div class="text-sm text-gray-500">Pengasuh Pondok Pesantren Roudlotut Tullab</div>
            </div>
        </div>
    </div>
</div>
@endsection