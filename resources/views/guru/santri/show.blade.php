@extends('layouts.admin')
@section('title', 'Detail Santri')
@section('content')

<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('guru.santri.index') }}" class="text-gray-500 hover:text-[#1e3a5f]">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <h1 class="text-2xl font-bold text-gray-800">Detail Santri</h1>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Card Profil --}}
    <div class="bg-white rounded-xl shadow-sm p-6 text-center">
        <div class="w-20 h-20 bg-[#1e3a5f] rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-3xl font-bold text-white">
                {{ strtoupper(substr($santriTingkat->santri->nama_lengkap, 0, 1)) }}
            </span>
        </div>
        <p class="font-bold text-gray-800 text-lg">{{ $santriTingkat->santri->nama_lengkap }}</p>
        <p class="text-sm text-gray-500">NIS: {{ $santriTingkat->santri->nis }}</p>
        <span class="inline-block mt-2 px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full font-semibold">
            {{ ucfirst($santriTingkat->santri->status) }}
        </span>
        <div class="mt-4 text-left space-y-2 border-t pt-4 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-500">Tingkat</span>
                <span class="font-medium">{{ $santriTingkat->tingkat->nama_tingkat }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Jenis Kelamin</span>
                <span class="font-medium">{{ $santriTingkat->santri->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Tempat Lahir</span>
                <span class="font-medium">{{ $santriTingkat->santri->tempat_lahir ?? '-' }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Tanggal Lahir</span>
                <span class="font-medium">
                    {{ $santriTingkat->santri->tanggal_lahir ? $santriTingkat->santri->tanggal_lahir->format('d M Y') : '-' }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Telepon</span>
                <span class="font-medium">{{ $santriTingkat->santri->telepon ?? '-' }}</span>
            </div>
        </div>
    </div>

    {{-- Alamat & Tahun Ajaran --}}
    <div class="lg:col-span-2 space-y-4">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Informasi Akademik</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Tahun Ajaran</p>
                    <p class="font-medium">{{ $santriTingkat->tahunAjaran->nama_tahun ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Status di Tingkat</p>
                    <p class="font-medium">{{ ucfirst($santriTingkat->status) }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Tanggal Mulai</p>
                    <p class="font-medium">{{ $santriTingkat->tanggal_mulai->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Alamat</p>
                    <p class="font-medium">{{ $santriTingkat->santri->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection