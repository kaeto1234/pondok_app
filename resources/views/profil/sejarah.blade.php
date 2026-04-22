@extends('layouts.app')

@section('title', 'Sejarah - Pondok Pesantren Roudlotut Tullab')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
            <span class="mx-2">/</span>
            <span class="text-[#166534]">Sejarah</span>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-2">Sejarah Berdirinya</h1>
            <p class="text-gray-500">Perjalanan panjang Pondok Pesantren Roudlotut Tullab</p>
        </div>

        <!-- Gambar -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-xl h-64 flex items-center justify-center mb-8">
            <span class="text-gray-400">Gambar Pondok Pesantren</span>
        </div>

        <!-- Konten -->
        <div class="text-gray-700 dark:text-gray-300 leading-relaxed space-y-4">
            <p>
                Pondok Pesantren Roudlotut Tullab didirikan pada tahun <strong class="text-[#166534]">1998</strong> oleh <strong>KH. Ahmad Maulana</strong>, seorang ulama karismatik yang memiliki visi besar untuk mencerdaskan umat melalui pendidikan agama yang berkualitas.
            </p>
            <p>
                Berawal dari sebuah musholla kecil dan beberapa santri, pondok ini terus berkembang hingga kini menjadi salah satu pondok pesantren terkemuka di wilayah Bogor.
            </p>
            <p>
                Nama <strong class="text-[#166534]">"Roudlotut Tullab"</strong> memiliki arti <strong>"Taman Para Penuntut Ilmu"</strong>, yang mencerminkan harapan pendiri agar pondok ini menjadi tempat yang nyaman untuk menimba ilmu.
            </p>
        </div>

        <!-- Timeline -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-10">
            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg text-center">
                <div class="text-xl font-bold text-[#166534]">1998</div>
                <div class="text-sm text-gray-500">Berdiri</div>
            </div>
            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg text-center">
                <div class="text-xl font-bold text-[#166534]">2005</div>
                <div class="text-sm text-gray-500">Madrasah Diniyah</div>
            </div>
            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg text-center">
                <div class="text-xl font-bold text-[#166534]">2010</div>
                <div class="text-sm text-gray-500">Asrama</div>
            </div>
            <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg text-center">
                <div class="text-xl font-bold text-[#166534]">2020</div>
                <div class="text-sm text-gray-500">Program Tahfidz</div>
            </div>
        </div>
    </div>
</div>
@endsection