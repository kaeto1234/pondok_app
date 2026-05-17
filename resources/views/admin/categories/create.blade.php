@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Kategori</h1>
    <p class="text-gray-500">Menambahkan kategori baru untuk konten website</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Nama Kategori</label>
            <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Deskripsi (Opsional)</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]"></textarea>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Icon (Opsional)</label>
            <input type="text" name="icon" placeholder="Contoh: building, newspaper, calendar" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            <p class="text-xs text-gray-400 mt-1">Nama icon Font Awesome (tanpa fa-)</p>
        </div>
        
        <div class="flex gap-3">
            <button type="submit" class="bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                <i class="fas fa-save mr-2"></i> Simpan
            </button>
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection