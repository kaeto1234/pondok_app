@extends('layouts.admin')

@section('title', 'Detail Pendaftaran - ' . $pendaftaran->no_pendaftaran)

@section('content')
<div class="mb-6 flex items-center space-x-3">
    <a href="{{ route('admin.ppdb.index') }}" class="text-gray-500 hover:text-navy-primary transition">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <h1 class="text-2xl font-bold text-gray-800">Detail Pendaftaran</h1>
</div>

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Informasi Utama -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Data Pribadi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">No. Pendaftaran</p>
                    <p class="font-medium">{{ $pendaftaran->no_pendaftaran }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Periode</p>
                    <p class="font-medium">{{ $pendaftaran->periodePendaftaran->nama }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Nama Lengkap</p>
                    <p class="font-medium">{{ $pendaftaran->nama_lengkap }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Jenis Kelamin</p>
                    <p class="font-medium">{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Tempat, Tanggal Lahir</p>
                    <p class="font-medium">{{ $pendaftaran->tempat_lahir ?? '-' }}, {{ $pendaftaran->tanggal_lahir ? $pendaftaran->tanggal_lahir->format('d M Y') : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Asal Sekolah</p>
                    <p class="font-medium">{{ $pendaftaran->asal_sekolah ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Alamat</p>
                    <p class="font-medium">{{ $pendaftaran->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Data Orang Tua</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Nama Orang Tua</p>
                    <p class="font-medium">{{ $pendaftaran->nama_orang_tua ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Telepon</p>
                    <p class="font-medium">{{ $pendaftaran->telepon_orang_tua ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Berkas Pendukung</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($pendaftaran->fileBerkas as $file)
                <div class="border rounded-lg p-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold">{{ $file->berkasPeriode->jenisBerkas->nama }}</p>
                        <p class="text-xs text-gray-500">File: {{ basename($file->path_file) }}</p>
                    </div>
                    <a href="{{ asset('storage/' . $file->path_file) }}" target="_blank" 
                       class="text-navy-primary hover:text-navy-hover p-2 rounded-full bg-gray-100">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
                @empty
                <p class="text-gray-500 text-sm italic md:col-span-2">Tidak ada berkas yang diunggah.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Sidebar Aksi -->
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Status & Verifikasi</h2>
            
            <div class="mb-6">
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Status Saat Ini</p>
                @if($pendaftaran->status == 'pending')
                    <span class="px-3 py-1 text-sm font-bold bg-yellow-100 text-yellow-700 rounded-full">PENDING</span>
                @elseif($pendaftaran->status == 'diverifikasi')
                    <span class="px-3 py-1 text-sm font-bold bg-green-100 text-green-700 rounded-full">DIVERIFIKASI</span>
                @else
                    <span class="px-3 py-1 text-sm font-bold bg-red-100 text-red-700 rounded-full">DITOLAK</span>
                @endif
            </div>

            @if($pendaftaran->status == 'pending')
            <div class="space-y-4">
                <form action="{{ route('admin.ppdb.verify', $pendaftaran->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Verifikasi (Opsional)</label>
                        <textarea name="catatan" rows="3" class="w-full border rounded-lg p-2 text-sm" placeholder="Contoh: Berkas sudah lengkap dan sesuai."></textarea>
                    </div>
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin memverifikasi data ini? Santri baru akan otomatis terdaftar.')"
                            class="w-full bg-green-600 text-white font-bold py-2 rounded-lg hover:bg-green-700 transition mb-2">
                        <i class="fas fa-check-circle mr-1"></i> Verifikasi & Terima
                    </button>
                </form>

                <form action="{{ route('admin.ppdb.reject', $pendaftaran->id) }}" method="POST">
                    @csrf
                    <button type="button" onclick="document.getElementById('reject-form').classList.toggle('hidden')" 
                            class="w-full bg-red-100 text-red-700 font-bold py-2 rounded-lg hover:bg-red-200 transition">
                        <i class="fas fa-times-circle mr-1"></i> Tolak Pendaftaran
                    </button>
                    
                    <div id="reject-form" class="mt-4 hidden">
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan</label>
                            <textarea name="catatan" required rows="3" class="w-full border rounded-lg p-2 text-sm" placeholder="Contoh: Berkas foto tidak jelas."></textarea>
                        </div>
                        <button type="submit" onclick="return confirm('Yakin ingin menolak pendaftaran ini?')"
                                class="w-full bg-red-600 text-white font-bold py-2 rounded-lg hover:bg-red-700 transition">
                            Konfirmasi Tolak
                        </button>
                    </div>
                </form>
            </div>
            @else
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Catatan Admin</p>
                <p class="text-sm">{{ $pendaftaran->catatan ?? '-' }}</p>
                <p class="text-xs text-gray-400 mt-2">Diverifikasi pada: {{ $pendaftaran->diverifikasi_pada ? $pendaftaran->diverifikasi_pada->format('d M Y H:i') : '-' }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
