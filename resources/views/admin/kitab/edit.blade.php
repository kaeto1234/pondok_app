@extends('layouts.admin')
@section('title', 'Edit Kitab')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Kitab</h1>
        <p class="text-gray-500 text-sm">Perbarui data kitab</p>
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

    <div class="bg-white rounded-xl shadow-md p-6 max-w-2xl">
        <form action="{{ route('admin.kitab.update', $kitab->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Kitab <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_kitab" value="{{ old('nama_kitab', $kitab->nama_kitab) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Pengarang</label>
                <input type="text" name="pengarang" value="{{ old('pengarang', $kitab->pengarang) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                <input type="text" name="penerbit" value="{{ old('penerbit', $kitab->penerbit) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $kitab->tahun_terbit) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm" min="1" max="9999">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('deskripsi', $kitab->deskripsi) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran Terkait</label>
                <div class="max-h-40 overflow-y-auto border rounded-lg p-2 bg-gray-50">
                    @php
                        $selectedMapel = old('mapel_ids', $kitab->mataPelajaran->pluck('id')->toArray());
                    @endphp
                    @forelse($mapelList as $mapel)
                        <label class="flex items-center gap-2 py-1 px-2 hover:bg-white rounded cursor-pointer">
                            <input type="checkbox" name="mapel_ids[]" value="{{ $mapel->id }}"
                                {{ in_array($mapel->id, $selectedMapel) ? 'checked' : '' }}
                                class="rounded text-navy-primary focus:ring-navy-primary">
                            <span class="text-sm text-gray-700">{{ $mapel->nama_mapel }}</span>
                        </label>
                    @empty
                        <p class="text-xs text-gray-400 italic">Belum ada mata pelajaran</p>
                    @endforelse
                </div>
            </div>

            <div class="flex gap-2">
                <button type="submit"
                    class="flex-1 bg-navy-primary text-white px-4 py-2 rounded-lg hover:bg-navy-hover transition text-sm">
                    <i class="fas fa-save mr-1"></i> Update
                </button>
                <a href="{{ route('admin.kitab.index') }}"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>

@endsection
