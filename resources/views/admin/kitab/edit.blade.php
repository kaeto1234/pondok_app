@extends('layouts.admin')
@section('title', 'Edit Kitab')
@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Kitab</h1>
</div>

<div class="bg-white rounded-xl shadow-sm p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.kitab.update', $kitab->id) }}">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kitab <span class="text-red-500">*</span></label>
                <input type="text" name="nama_kitab" value="{{ old('nama_kitab', $kitab->nama_kitab) }}"
                    class="w-full border rounded-lg px-4 py-2 text-sm" required>
                @error('nama_kitab') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pengarang</label>
                <input type="text" name="pengarang" value="{{ old('pengarang', $kitab->pengarang) }}"
                    class="w-full border rounded-lg px-4 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Penerbit</label>
                <input type="text" name="penerbit" value="{{ old('penerbit', $kitab->penerbit) }}"
                    class="w-full border rounded-lg px-4 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $kitab->tahun_terbit) }}"
                    class="w-full border rounded-lg px-4 py-2 text-sm">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                    class="w-full border rounded-lg px-4 py-2 text-sm">{{ old('deskripsi', $kitab->deskripsi) }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran yang Menggunakan Kitab Ini</label>
                @php $selectedMapel = old('mapel_ids', $kitab->mataPelajaran->pluck('id')->toArray()); @endphp
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                    @foreach($mapelList as $m)
                        <label class="flex items-center gap-2 text-sm cursor-pointer">
                            <input type="checkbox" name="mapel_ids[]" value="{{ $m->id }}"
                                {{ in_array($m->id, $selectedMapel) ? 'checked' : '' }}
                                class="rounded">
                            {{ $m->nama_mapel }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex gap-3 mt-6">
            <button type="submit" class="bg-navy-primary text-white px-6 py-2 rounded-lg hover:bg-navy-hover transition">
                <i class="fas fa-save mr-1"></i> Update
            </button>
            <a href="{{ route('admin.kitab.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection