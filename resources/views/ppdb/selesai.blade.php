@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto text-center">

        @if($pendaftaran->status == 'diverifikasi')
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check-circle text-5xl text-green-600"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Pendaftaran Diverifikasi!</h1>
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                <p class="text-gray-600 mb-2">Nomor Pendaftaran Anda:</p>
                <p class="text-2xl font-bold text-primary mb-2">{{ $pendaftaran->no_pendaftaran }}</p>
                <span class="inline-block bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider">
                    <i class="fas fa-check-circle mr-1"></i> Diverifikasi
                </span>
            </div>
            <p class="text-gray-600 mb-4">
                Selamat! Pendaftaran Anda telah diverifikasi. Silakan cek email untuk informasi akun login wali santri.
            </p>

        @elseif($pendaftaran->status == 'ditolak')
            <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-times-circle text-5xl text-red-600"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Pendaftaran Ditolak</h1>
            <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
                <p class="text-gray-600 mb-2">Nomor Pendaftaran Anda:</p>
                <p class="text-2xl font-bold text-primary mb-2">{{ $pendaftaran->no_pendaftaran }}</p>
                <span class="inline-block bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider">
                    <i class="fas fa-times-circle mr-1"></i> Ditolak
                </span>
                @if($pendaftaran->catatan)
                    <p class="mt-3 text-sm text-red-600"><strong>Alasan:</strong> {{ $pendaftaran->catatan }}</p>
                @endif
            </div>
            <p class="text-gray-600 mb-4">
                Mohon maaf, pendaftaran Anda tidak dapat kami terima. Silakan hubungi pihak pesantren untuk informasi lebih lanjut.
            </p>

        @else
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check-circle text-5xl text-green-600"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Formulir Terkirim!</h1>
            <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
                <p class="text-gray-600 mb-2">Nomor Pendaftaran Anda:</p>
                <p class="text-2xl font-bold text-primary mb-2">{{ $pendaftaran->no_pendaftaran }}</p>
                <span class="inline-block bg-orange-100 text-orange-700 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider">
                    <i class="fas fa-clock mr-1"></i> Menunggu Verifikasi Admin
                </span>
            </div>
            <p class="text-gray-600 mb-4">
                Terima kasih! Data Anda telah masuk ke sistem kami. Silakan simpan nomor di atas untuk mengecek status pendaftaran Anda secara berkala.
            </p>
        @endif

        <div class="flex gap-4 justify-center">
            <a href="{{ url('/') }}" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primaryDark transition">
                Kembali ke Beranda
            </a>
            <a href="{{ url('/ppdb') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                Lihat Info PPDB
            </a>
        </div>
    </div>
</div>
@endsection