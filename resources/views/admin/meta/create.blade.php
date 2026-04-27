@extends('layouts.admin')

@section('title', 'Tambah Data')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Data {{ $title }}</h1>
    <p class="text-gray-500">Menambahkan data baru ke {{ $title }} pondok pesantren</p>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form method="POST" action="{{ url('/admin/meta/store') }}">
        @csrf
        <input type="hidden" name="meta_group" value="{{ $group }}">
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Key (Nama Data)</label>
            <input type="text" name="meta_key" required class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]">
            <p class="text-xs text-gray-400 mt-1">Contoh: motto, budaya_pondok, struktur_organisasi</p>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Value (Isi Data)</label>
            <textarea name="meta_value" rows="10" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]"></textarea>
            <p class="text-xs text-gray-400 mt-1">Gunakan HTML untuk format teks (paragraf, list, dll)</p>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Urutan</label>
            <input type="number" name="order" value="0" class="w-full md:w-48 border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]">
            <p class="text-xs text-gray-400 mt-1">Semakin kecil angka, semakin atas posisinya</p>
        </div>
        
        <div class="flex gap-3 mt-6">
            <button type="submit" class="bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                <i class="fas fa-save mr-2"></i> Simpan
            </button>
            <a href="{{ url('/admin/meta/'.$group) }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection