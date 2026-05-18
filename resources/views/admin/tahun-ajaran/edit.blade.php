@extends('layouts.admin')

@section('title', 'Edit Tahun Ajaran')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Tahun Ajaran</h1>
    <p class="text-gray-500">Mengubah data tahun ajaran</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.tahun-ajaran.update', $tahunAjaran->id) }}">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Nama Tahun Ajaran <span class="text-red-500">*</span></label>
            <input type="text" name="nama_tahun" value="{{ old('nama_tahun', $tahunAjaran->nama_tahun) }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
            <p class="text-xs text-gray-400 mt-1">Format: YYYY/YYYY (contoh: 2025/2026)</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', $tahunAjaran->tanggal_mulai) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $tahunAjaran->tanggal_selesai) }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
        </div>
        
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ $tahunAjaran->is_active ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700">Aktifkan tahun ajaran ini</span>
            </label>
            <p class="text-xs text-gray-400 mt-1">Hanya satu tahun ajaran yang bisa aktif dalam satu waktu</p>
        </div>
        
        <div class="flex gap-3">
            <button type="submit" class="bg-navy-primary text-white px-6 py-2 rounded-lg hover:bg-navy-hover transition">
                Update
            </button>
            <a href="{{ route('admin.tahun-ajaran.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection