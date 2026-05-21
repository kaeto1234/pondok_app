@extends('layouts.admin')
@section('title', 'Detail Santri')
@section('content')

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('admin.santri.index') }}" class="text-gray-500 hover:text-[#1e3a5f]">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="flex-1 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Detail Santri</h1>
            <a href="{{ route('admin.santri.edit', $santri->id) }}"
                class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg text-sm hover:bg-[#2a4a7a] transition">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Profil --}}
        <div class="bg-white rounded-xl shadow-sm p-6 text-center">
            <div class="w-20 h-20 bg-[#1e3a5f] rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl font-bold text-white">
                    {{ strtoupper(substr($santri->nama_lengkap, 0, 1)) }}
                </span>
            </div>
            <p class="font-bold text-gray-800 text-lg">{{ $santri->nama_lengkap }}</p>
            <p class="text-sm text-gray-500">NIS: {{ $santri->nis }}</p>
            <span
                class="inline-block mt-2 px-3 py-1 text-xs rounded-full font-semibold
            {{ $santri->status == 'aktif'
                ? 'bg-green-100 text-green-700'
                : ($santri->status == 'lulus'
                    ? 'bg-blue-100 text-blue-700'
                    : 'bg-red-100 text-red-700') }}">
                {{ ucfirst($santri->status) }}
            </span>
            <div class="mt-4 text-left space-y-2 border-t pt-4 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Jenis Kelamin</span>
                    <span class="font-medium">{{ $santri->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tempat Lahir</span>
                    <span class="font-medium">{{ $santri->tempat_lahir ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Tanggal Lahir</span>
                    <span class="font-medium">
                        {{ $santri->tanggal_lahir ? $santri->tanggal_lahir->format('d M Y') : '-' }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Telepon</span>
                    <span class="font-medium">{{ $santri->telepon ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-4">
            {{-- Riwayat Tingkat --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Riwayat Tingkat</h2>
                @forelse($santri->santriTingkat as $st)
                    <div class="flex justify-between items-center py-2 border-b last:border-0 text-sm">
                        <div>
                            <p class="font-medium">{{ $st->tingkat->nama_tingkat }}</p>
                            <p class="text-xs text-gray-400">{{ $st->tahunAjaran->nama_tahun ?? '-' }}</p>
                        </div>
                        <span
                            class="px-2 py-1 text-xs rounded-full
                    {{ $st->status == 'aktif'
                        ? 'bg-green-100 text-green-700'
                        : ($st->status == 'lulus'
                            ? 'bg-blue-100 text-blue-700'
                            : 'bg-gray-100 text-gray-500') }}">
                            {{ ucfirst($st->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">Belum ada data tingkat.</p>
                @endforelse
            </div>

            {{-- Data Orang Tua --}}
            @if ($santri->orangTua->isNotEmpty())
                @php $orangTua = $santri->orangTua->first(); @endphp
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Data Orang Tua</h2>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-gray-500">Nama Ayah</p>
                            <p class="font-medium">{{ $orangTua->nama_ayah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Pekerjaan Ayah</p>
                            <p class="font-medium">{{ $orangTua->pekerjaan_ayah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Nama Ibu</p>
                            <p class="font-medium">{{ $orangTua->nama_ibu ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Pekerjaan Ibu</p>
                            <p class="font-medium">{{ $orangTua->pekerjaan_ibu ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Telepon Ayah</p>
                            <p class="font-medium">{{ $orangTua->telepon_ayah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Telepon Ibu</p>
                            <p class="font-medium">{{ $orangTua->telepon_ibu ?? '-' }}</p>
                        </div>
                        @if ($orangTua->user)
                            <div class="col-span-2">
                                <p class="text-gray-500">Email Wali (Login)</p>
                                <p class="font-medium">{{ $orangTua->user->email }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Pendaftaran --}}
            @if ($santri->pendaftaran)
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Data Pendaftaran</h2>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-gray-500">No. Pendaftaran</p>
                            <p class="font-medium">{{ $santri->pendaftaran->no_pendaftaran }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Asal Sekolah</p>
                            <p class="font-medium">{{ $santri->pendaftaran->asal_sekolah ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Tanggal Daftar</p>
                            <p class="font-medium">{{ $santri->pendaftaran->tanggal_daftar->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
