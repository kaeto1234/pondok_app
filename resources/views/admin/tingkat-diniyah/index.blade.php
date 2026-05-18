@extends('layouts.admin')
@section('title', 'Tingkat Diniyah')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tingkat Diniyah</h1>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Form Tambah --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Tambah Tingkat</h2>
            <form method="POST" action="{{ route('admin.tingkat-diniyah.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Tingkat</label>
                    <input type="text" name="nama_tingkat" value="{{ old('nama_tingkat') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm" placeholder="Contoh: Ula 1" required>
                    @error('nama_tingkat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="urutan" value="{{ old('urutan') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm" placeholder="Otomatis">
                </div>
                <button type="submit"
                    class="w-full bg-navy-primary text-white py-2 rounded-lg hover:bg-navy-hover transition text-sm">
                    <i class="fas fa-plus mr-1"></i> Tambahkan
                </button>
            </form>
        </div>

        {{-- Daftar --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Urutan</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama Tingkat</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tingkatan as $t)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3 text-sm text-gray-500">{{ $t->urutan }}</td>
                            <td class="px-6 py-3 font-medium">{{ $t->nama_tingkat }}</td>
                            <td class="px-6 py-3">
                                @if ($t->is_active)
                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">Aktif</span>
                                @else
                                    <span class="px-2 py-1 text-xs bg-gray-100 text-gray-500 rounded-full">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-3">
                                <div class="flex gap-2" x-data="{ open: false }">
                                    <button @click="open = !open" class="text-yellow-600 hover:text-yellow-800 text-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.tingkat-diniyah.destroy', $t->id) }}" method="POST"
                                        class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                            onclick="return confirm('Yakin hapus tingkat ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                    <div x-show="open"
                                        class="absolute mt-8 bg-white border rounded-lg shadow-lg p-4 z-10 w-64">
                                        <form method="POST" action="{{ route('admin.tingkat-diniyah.update', $t->id) }}">
                                            @csrf @method('PUT')
                                            <input type="text" name="nama_tingkat" value="{{ $t->nama_tingkat }}"
                                                class="w-full border rounded px-2 py-1 text-sm mb-2">
                                            <input type="number" name="urutan" value="{{ $t->urutan }}"
                                                class="w-full border rounded px-2 py-1 text-sm mb-2">
                                            <select name="is_active" class="w-full border rounded px-2 py-1 text-sm mb-2">
                                                <option value="1" {{ $t->is_active ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ !$t->is_active ? 'selected' : '' }}>Nonaktif
                                                </option>
                                            </select>
                                            <button type="submit"
                                                class="w-full bg-navy-primary text-white py-1 rounded text-sm">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection
