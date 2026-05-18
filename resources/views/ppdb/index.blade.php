@extends('layouts.app')

@section('title', 'PPDB - Pondok Pesantren Roudlotut Tullab')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-sm text-gray-500 mb-6">
                <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
                <span class="mx-2">/</span>
                <span class="text-[#166534]">PPDB</span>
            </div>

            <div class="text-center mb-10">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-white mb-4">Penerimaan Santri Baru</h1>
                <div class="w-24 h-1 bg-primary mx-auto mt-4 rounded-full"></div>
                <p class="text-gray-500 mt-4">Tahun Ajaran 2026/2027</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-alt text-2xl text-primary"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Syarat Pendaftaran</h3>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 text-left space-y-1">
                        <li>• Ijazah SD/MI</li>
                        <li>• Akta Kelahiran</li>
                        <li>• Kartu Keluarga</li>
                        <li>• Pas Foto 3x4</li>
                        <li>• KTP Orang Tua</li>
                    </ul>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-2xl text-primary"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Jadwal Pendaftaran</h3>
                    <ul class="text-sm text-gray-600 dark:text-gray-400 text-left space-y-1">
                        <li>• Gelombang 1: Jan - Mar 2026</li>
                        <li>• Gelombang 2: Apr - Jun 2026</li>
                        <li>• Tes: Juli 2026</li>
                        <li>• Pengumuman: Agustus 2026</li>
                    </ul>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-money-bill-wave text-2xl text-primary"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Biaya Pendaftaran</h3>
                    <p class="text-2xl font-bold text-primary">Rp 150.000</p>
                    <p class="text-sm text-gray-500 mt-2">(Termasuk formulir dan administrasi)</p>
                </div>
            </div>

            <div class="text-center space-y-3">
                <a href="{{ url('/ppdb/daftar') }}"
                    class="bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-primaryDark transition shadow-lg inline-block">
                    <i class="fas fa-arrow-right mr-2"></i> Daftar Sekarang
                </a>
                <div>
                    <a href="{{ route('ppdb.cek-status') }}" class="text-primary hover:underline text-sm">
                        <i class="fas fa-search mr-1"></i> Sudah daftar? Cek status pendaftaran di sini
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
