@extends('layouts.admin')

@section('title', 'Tambah Jenis Berkas')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Jenis Berkas</h1>
    <p class="text-gray-500">Menambahkan master jenis berkas untuk PPDB</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.jenis-berkas.store') }}">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Nama Berkas <span class="text-red-500">*</span></label>
            <input type="text" name="nama" required class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="Contoh: Ijazah, Akta Kelahiran, Kartu Keluarga">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Tipe File</label>
            <input type="text" name="tipe_file" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="pdf,jpg,png">
            <p class="text-xs text-gray-400 mt-1">Pisahkan dengan koma. Default: pdf,jpg,png</p>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Ukuran Maksimal (KB)</label>
            <input type="number" name="ukuran_maksimal" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="2048">
            <p class="text-xs text-gray-400 mt-1">Default: 2048 KB (2 MB)</p>
        </div>
        
        <div class="flex gap-3">
            <button type="submit" class="bg-navy-primary text-white px-6 py-2 rounded-lg hover:bg-navy-hover transition">
                Simpan
            </button>
            <a href="{{ route('admin.jenis-berkas.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection