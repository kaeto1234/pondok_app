@extends('layouts.admin')

@section('title', 'Jenis Ujian')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Jenis Ujian</h1>
        <p class="text-sm text-gray-500 mt-1">
            <i class="fas fa-info-circle mr-1"></i>
            Kelola jenis ujian dan bobot nilainya. Total bobot maksimal 100%.
        </p>
    </div>

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

        {{-- KIRI: FORM TAMBAH --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">
                    <i class="fas fa-plus-circle text-navy-primary mr-2"></i> Tambah Jenis Ujian
                </h2>

                <form action="{{ route('admin.jenis-ujian.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Jenis Ujian <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            placeholder="Contoh: Ujian Praktik" required>
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Bobot (%) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="bobot" value="{{ old('bobot') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            placeholder="Contoh: 20" min="1" max="100" required>
                        @error('bobot')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                        <textarea name="keterangan" rows="2"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            placeholder="Keterangan singkat">{{ old('keterangan') }}</textarea>
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

        {{-- KANAN: TABEL DAFTAR --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
                    <h2 class="font-semibold text-gray-700">
                        <i class="fas fa-star text-navy-primary mr-2"></i> Daftar Jenis Ujian
                    </h2>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-500">
                            Total Bobot:
                            <span class="font-bold {{ $totalBobot == 100 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $totalBobot }}%
                            </span>
                        </span>
                        @if ($totalBobot == 100)
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">
                                <i class="fas fa-check-circle"></i> OK
                            </span>
                        @else
                            <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded-full">
                                <i class="fas fa-exclamation-circle"></i> Belum 100%
                            </span>
                        @endif
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Bobot</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Keterangan
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Dipakai</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jenisUjian as $ju)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-sm">{{ $ju->nama }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="inline-block bg-navy-primary text-white text-xs px-2 py-1 rounded-full font-bold">
                                            {{ $ju->bobot }}%
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $ju->keterangan ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center text-sm">
                                        @if ($ju->nilai_count > 0)
                                            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                                                {{ $ju->nilai_count }} nilai
                                            </span>
                                        @else
                                            <span class="text-xs text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('admin.jenis-ujian.edit', $ju->id) }}"
                                                class="text-yellow-600 hover:text-yellow-800 text-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.jenis-ujian.destroy', $ju->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                                    onclick="return confirm('Yakin hapus jenis ujian {{ $ju->nama }}?')"
                                                    title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                        <i class="fas fa-star text-3xl text-gray-300 mb-2 block"></i>
                                        Belum ada data jenis ujian.
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
