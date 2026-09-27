@extends('layouts.admin')

@section('title', 'Edit Jenis Ujian')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Jenis Ujian</h1>
        <p class="text-gray-500 text-sm">Perbarui data jenis ujian</p>
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
        <form action="{{ route('admin.jenis-ujian.update', $jenisUjian->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Jenis Ujian <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama" value="{{ old('nama', $jenisUjian->nama) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Bobot (%) <span class="text-red-500">*</span>
                </label>
                <input type="number" name="bobot" value="{{ old('bobot', $jenisUjian->bobot) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm" min="1" max="100" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                <textarea name="keterangan" rows="3" class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('keterangan', $jenisUjian->keterangan) }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit"
                    class="flex-1 bg-navy-primary text-white px-4 py-2 rounded-lg hover:bg-navy-hover transition text-sm">
                    <i class="fas fa-save mr-1"></i> Update
                </button>
                <a href="{{ route('admin.jenis-ujian.index') }}"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
