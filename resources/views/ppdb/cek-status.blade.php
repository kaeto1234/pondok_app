@extends('layouts.app')

@section('title', 'Cek Status Pendaftaran - PPDB')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">

        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/ppdb') }}" class="hover:text-[#166534]">PPDB</a>
            <span class="mx-2">/</span>
            <span class="text-[#166534]">Cek Status</span>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
            <div class="bg-primary px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Cek Status Pendaftaran</h1>
                <p class="text-white/80 text-sm">Masukkan nomor pendaftaran untuk melihat status</p>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('ppdb.hasil-cek-status') }}" class="flex gap-3 mb-6">
                    @csrf
                    <input type="text" name="no_pendaftaran"
                        value="{{ old('no_pendaftaran', request('no_pendaftaran') ?? (isset($pendaftaran) ? $pendaftaran->no_pendaftaran : '')) }}"
                        placeholder="Contoh: REG-20260517-XXXXXX"
                        class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary"
                        required>
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primaryDark transition whitespace-nowrap">
                        <i class="fas fa-search mr-1"></i> Cek
                    </button>
                </form>

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- Hasil pencarian --}}
                @isset($pendaftaran)
                    @if($pendaftaran)
                        <div class="border rounded-xl overflow-hidden">

                            {{-- Header status --}}
                            @if($pendaftaran->status == 'diverifikasi')
                                <div class="bg-green-500 px-6 py-4 text-white text-center">
                                    <i class="fas fa-check-circle text-3xl mb-1"></i>
                                    <p class="font-bold text-lg">PENDAFTARAN DIVERIFIKASI</p>
                                    <p class="text-sm text-white/80">Selamat! Pendaftaran Anda telah diterima</p>
                                </div>
                            @elseif($pendaftaran->status == 'ditolak')
                                <div class="bg-red-500 px-6 py-4 text-white text-center">
                                    <i class="fas fa-times-circle text-3xl mb-1"></i>
                                    <p class="font-bold text-lg">PENDAFTARAN DITOLAK</p>
                                    <p class="text-sm text-white/80">Mohon maaf, pendaftaran Anda tidak dapat diterima</p>
                                </div>
                            @else
                                <div class="bg-orange-400 px-6 py-4 text-white text-center">
                                    <i class="fas fa-clock text-3xl mb-1"></i>
                                    <p class="font-bold text-lg">MENUNGGU VERIFIKASI</p>
                                    <p class="text-sm text-white/80">Pendaftaran Anda sedang dalam proses verifikasi</p>
                                </div>
                            @endif

                            {{-- Detail pendaftaran --}}
                            <div class="p-6 space-y-3">
                                <div class="grid grid-cols-2 gap-2 text-sm">
                                    <div>
                                        <p class="text-gray-500">No. Pendaftaran</p>
                                        <p class="font-semibold">{{ $pendaftaran->no_pendaftaran }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Tahun Ajaran</p>
                                        <p class="font-semibold">{{ $pendaftaran->tahunAjaran->nama_tahun ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Nama Lengkap</p>
                                        <p class="font-semibold">{{ $pendaftaran->nama_lengkap }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Tanggal Daftar</p>
                                        <p class="font-semibold">{{ $pendaftaran->tanggal_daftar->format('d M Y H:i') }}</p>
                                    </div>
                                </div>

                                @if($pendaftaran->status == 'ditolak' && $pendaftaran->catatan)
                                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mt-3">
                                        <p class="text-sm font-semibold text-red-700 mb-1">Alasan Penolakan:</p>
                                        <p class="text-sm text-red-600">{{ $pendaftaran->catatan }}</p>
                                    </div>
                                @endif

                                @if($pendaftaran->status == 'diverifikasi')
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mt-3">
                                        <p class="text-sm text-green-700">
                                            <i class="fas fa-envelope mr-1"></i>
                                            Informasi akun login telah dikirim ke email wali santri.
                                            Silakan cek inbox atau folder spam.
                                        </p>
                                    </div>
                                @endif

                                @if($pendaftaran->status == 'pending')
                                    <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 mt-3">
                                        <p class="text-sm text-orange-700">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Proses verifikasi membutuhkan waktu 1-3 hari kerja.
                                            Silakan cek kembali secara berkala.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>

                    @else
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-8 text-center">
                            <i class="fas fa-search text-4xl text-gray-300 mb-3"></i>
                            <p class="text-gray-600 font-medium">Nomor pendaftaran tidak ditemukan</p>
                            <p class="text-gray-400 text-sm mt-1">Pastikan nomor yang Anda masukkan sudah benar</p>
                        </div>
                    @endif
                @endisset
            </div>
        </div>

    </div>
</div>
@endsection