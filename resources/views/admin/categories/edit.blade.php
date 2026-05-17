@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Kategori</h1>
    <p class="text-gray-500">Mengubah data kategori</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Nama Kategori</label>
            <input type="text" name="name" value="{{ $category->name }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Deskripsi (Opsional)</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ $category->description }}</textarea>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Icon (Opsional)</label>
            <input type="text" name="icon" value="{{ $category->icon }}" placeholder="Contoh: building, newspaper, calendar" class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
        
        <div class="flex gap-3">
            <button type="submit" class="bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                <i class="fas fa-save mr-2"></i> Update
            </button>
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection