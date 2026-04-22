@extends('layouts.app')

@section('title', 'Visi & Misi - Pondok Pesantren Roudlotut Tullab')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-[#166534]">Visi & Misi</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-2">Visi & Misi</h1>
            <p class="text-gray-500">Tujuan dan cita-cita Pondok Pesantren Roudlotut Tullab</p>
        </div>

        <!-- Visi -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Visi</h2>
            <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-6">
                <p class="text-gray-700 dark:text-gray-300 text-lg italic text-center">
                    "Menjadi pondok pesantren yang unggul dalam mencetak generasi yang beriman, berilmu, dan berakhlak mulia serta mampu bersaing di era global."
                </p>
            </div>
        </div>

        <!-- Misi -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Misi</h2>
            <div class="bg-gray-100 dark:bg-gray-800 rounded-xl p-6">
                <ol class="space-y-3 text-gray-700 dark:text-gray-300">
                    <li class="flex gap-2">
                        <span class="text-[#166534] font-bold">1.</span>
                        <span>Menyelenggarakan pendidikan agama yang berkualitas dengan metode modern berbasis kitab kuning.</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-[#166534] font-bold">2.</span>
                        <span>Mengembangkan program tahfidz Al-Qur'an dengan target hafalan 30 juz.</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-[#166534] font-bold">3.</span>
                        <span>Membekali santri dengan keterampilan bahasa Arab dan Inggris sebagai bekal komunikasi global.</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-[#166534] font-bold">4.</span>
                        <span>Menanamkan nilai-nilai akhlak mulia dalam kehidupan sehari-hari santri.</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-[#166534] font-bold">5.</span>
                        <span>Mempersiapkan santri yang mandiri dan berdaya saing tinggi.</span>
                    </li>
                    <li class="flex gap-2">
                        <span class="text-[#166534] font-bold">6.</span>
                        <span>Menjalin kerjasama dengan lembaga pendidikan dalam dan luar negeri.</span>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection