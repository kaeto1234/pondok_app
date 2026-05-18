@extends('layouts.admin')

@section('title', 'Informasi Yayasan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Informasi Yayasan</h1>
    <p class="text-gray-500">Kelola informasi yayasan yang tampil di footer website</p>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form method="POST" action="{{ route('admin.yayasan.update') }}">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Nama Yayasan</label>
                <input type="text" name="nama_yayasan" value="{{ old('nama_yayasan', $yayasan->nama_yayasan ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Telepon</label>
                <input type="text" name="telepon" value="{{ old('telepon', $yayasan->telepon ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $yayasan->email ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">WhatsApp</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp', $yayasan->whatsapp ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
            <div class="col-span-2">
                <label class="block text-gray-700 font-medium mb-2">Alamat</label>
                <textarea name="alamat" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('alamat', $yayasan->alamat ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Facebook</label>
                <input type="url" name="facebook" value="{{ old('facebook', $yayasan->facebook ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="https://...">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Instagram</label>
                <input type="url" name="instagram" value="{{ old('instagram', $yayasan->instagram ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="https://...">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Twitter</label>
                <input type="url" name="twitter" value="{{ old('twitter', $yayasan->twitter ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="https://...">
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">YouTube</label>
                <input type="url" name="youtube" value="{{ old('youtube', $yayasan->youtube ?? '') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="https://...">
            </div>
            <div class="col-span-2">
                <label class="block text-gray-700 font-medium mb-2">Google Maps (iframe)</label>
                <textarea name="google_maps" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 font-mono text-sm">{{ old('google_maps', $yayasan->google_maps ?? '') }}</textarea>
                <p class="text-xs text-gray-400 mt-1">Masukkan kode embed iframe dari Google Maps</p>
            </div>
        </div>
        
        <div class="flex gap-3 mt-6">
            <button type="submit" class="bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                <i class="fas fa-save mr-2"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection