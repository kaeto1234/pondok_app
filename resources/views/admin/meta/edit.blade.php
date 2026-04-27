@extends('layouts.admin')

@section('title', 'Edit ' . ucfirst(str_replace('_', ' ', $meta->meta_key)))

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit {{ ucfirst(str_replace('_', ' ', $meta->meta_key)) }}</h1>
    <p class="text-gray-500">Perbarui data {{ ucfirst(str_replace('_', ' ', $meta->meta_key)) }} pondok pesantren</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-3xl">
    <form method="POST" action="{{ url('/admin/meta/update/'.$meta->id) }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">{{ ucfirst(str_replace('_', ' ', $meta->meta_key)) }}</label>
            @if(strlen($meta->meta_value) > 200)
                <textarea name="meta_value" rows="12" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]">{{ $meta->meta_value }}</textarea>
                <p class="text-xs text-gray-400 mt-1">Gunakan HTML untuk format teks (paragraf, list, dll)</p>
            @else
                <input type="text" name="meta_value" value="{{ $meta->meta_value }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]">
            @endif
        </div>
        <div class="flex gap-3">
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