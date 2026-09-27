@extends('layouts.admin')
@section('title', 'Manajemen Kitab')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Kitab</h1>
        <p class="text-gray-500 text-sm">Kelola data kitab dan relasinya dengan mata pelajaran</p>
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
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KIRI: FORM TAMBAH KITAB --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">
                    <i class="fas fa-plus-circle text-navy-primary mr-2"></i> Tambah Kitab
                </h2>

                <form action="{{ route('admin.kitab.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Kitab <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_kitab" value="{{ old('nama_kitab') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            placeholder="Contoh: Jurumiyah" required>
                        @error('nama_kitab')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pengarang</label>
                        <input type="text" name="pengarang" value="{{ old('pengarang') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            placeholder="Contoh: Imam Ash-Shanhaji">
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                        <input type="text" name="penerbit" value="{{ old('penerbit') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            placeholder="Contoh: Darul Kutub">
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            placeholder="Contoh: 1901" min="1" max="9999">
                        @error('tahun_terbit')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            placeholder="Deskripsi singkat kitab">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Mata Pelajaran Terkait
                        </label>
                        <div class="max-h-40 overflow-y-auto border rounded-lg p-2 bg-gray-50">
                            @forelse($mapelList as $mapel)
                                <label class="flex items-center gap-2 py-1 px-2 hover:bg-white rounded cursor-pointer">
                                    <input type="checkbox" name="mapel_ids[]" value="{{ $mapel->id }}"
                                        {{ in_array($mapel->id, old('mapel_ids', [])) ? 'checked' : '' }}
                                        class="rounded text-navy-primary focus:ring-navy-primary">
                                    <span class="text-sm text-gray-700">{{ $mapel->nama_mapel }}</span>
                                </label>
                            @empty
                                <p class="text-xs text-gray-400 italic">Belum ada mata pelajaran</p>
                            @endforelse
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Pilih satu atau lebih mata pelajaran</p>
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

        {{-- KANAN: TABEL DAFTAR KITAB --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
                    <h2 class="font-semibold text-gray-700">
                        <i class="fas fa-book text-navy-primary mr-2"></i> Daftar Kitab
                    </h2>
                    <span class="text-xs text-gray-500">Total: {{ $kitab->total() }} kitab</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Kitab
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Pengarang</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tahun</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Mapel</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kitab as $k)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-sm">{{ $k->nama_kitab }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $k->pengarang ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $k->tahun_terbit ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-1">
                                            @forelse($k->mataPelajaran as $m)
                                                <span
                                                    class="px-2 py-0.5 text-xs bg-blue-100 text-blue-700 rounded-full">{{ $m->nama_mapel }}</span>
                                            @empty
                                                <span class="text-xs text-gray-400 italic">-</span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.kitab.edit', $k->id) }}"
                                                class="text-yellow-600 hover:text-yellow-800 text-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.kitab.destroy', $k->id) }}" method="POST"
                                                class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                                    onclick="return confirm('Yakin hapus kitab ini?')" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                        <i class="fas fa-book-open text-3xl text-gray-300 mb-2 block"></i>
                                        Belum ada data kitab.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($kitab->hasPages())
                    <div class="px-6 py-4 border-t bg-gray-50">{{ $kitab->links() }}</div>
                @endif
            </div>
        </div>

    </div>

@endsection
