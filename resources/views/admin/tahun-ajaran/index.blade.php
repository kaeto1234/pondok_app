@extends('layouts.admin')

@section('title', 'Manajemen Tahun Ajaran')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Tahun Ajaran</h1>
        <p class="text-sm text-gray-500 mt-1">
            <i class="fas fa-info-circle mr-1"></i>
            Klik "Aktifkan" untuk mengganti tahun ajaran aktif. Tahun ajaran sebelumnya otomatis dinonaktifkan.
        </p>
    </div>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KIRI: FORM TAMBAH TAHUN AJARAN --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">
                    <i class="fas fa-plus-circle text-navy-primary mr-2"></i> Tambah Tahun Ajaran
                </h2>

                <form action="{{ route('admin.tahun-ajaran.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Tahun Ajaran <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_tahun" value="{{ old('nama_tahun') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            placeholder="Contoh: 2025/2026" required>
                        <p class="text-xs text-gray-400 mt-1">Format: YYYY/YYYY</p>
                        @error('nama_tahun')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary">
                        @error('tanggal_mulai')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary">
                        @error('tanggal_selesai')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="flex-1 bg-navy-primary text-white px-4 py-2 rounded-lg hover:bg-navy-hover transition text-sm">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                        <button type="reset"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- KANAN: TABEL DAFTAR TAHUN AJARAN --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
                    <h2 class="font-semibold text-gray-700">
                        <i class="fas fa-calendar-alt text-navy-primary mr-2"></i> Daftar Tahun Ajaran
                    </h2>
                    <span class="text-xs text-gray-500">Total: {{ $tahunAjaran->count() }} tahun ajaran</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Tahun
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Mulai</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Selesai</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tahunAjaran as $ta)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-sm">{{ $ta->nama_tahun }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ $ta->tanggal_mulai ? $ta->tanggal_mulai->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ $ta->tanggal_selesai ? $ta->tanggal_selesai->format('d M Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($ta->is_active)
                                            <span
                                                class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                                                <i class="fas fa-check-circle mr-1"></i>Aktif
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-500 rounded-full">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2 flex-wrap">
                                            @if (!$ta->is_active)
                                                <form action="{{ route('admin.tahun-ajaran.set-active', $ta->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="text-green-600 hover:text-green-800 text-sm"
                                                        onclick="return confirm('Aktifkan tahun ajaran {{ $ta->nama_tahun }}?')">
                                                        <i class="fas fa-check-circle mr-1"></i> Aktifkan
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('admin.berkas-tahun-ajaran.index', $ta->id) }}"
                                                class="text-blue-600 hover:text-blue-800 text-sm">
                                                <i class="fas fa-folder-open mr-1"></i> Berkas
                                            </a>
                                            <a href="{{ route('admin.tahun-ajaran.edit', $ta->id) }}"
                                                class="text-yellow-600 hover:text-yellow-800 text-sm">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            @if (!$ta->is_active)
                                                <form action="{{ route('admin.tahun-ajaran.destroy', $ta->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                                        onclick="return confirm('Yakin ingin menghapus tahun ajaran {{ $ta->nama_tahun }}?')">
                                                        <i class="fas fa-trash mr-1"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                        <i class="fas fa-calendar-times text-3xl text-gray-300 mb-2 block"></i>
                                        Belum ada data tahun ajaran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
