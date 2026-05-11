@extends('layouts.admin')

@section('title', 'Tambah Menu')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Menu</h1>
    <p class="text-gray-500">Menambahkan menu baru ke navigasi website</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.menus.store') }}">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Label Menu</label>
            <input type="text" name="label" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]">
            <p class="text-xs text-gray-400 mt-1">Contoh: Profil, Berita, Kegiatan, Prestasi</p>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Parent Menu (opsional)</label>
            <select name="parent_id" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                <option value="">Tanpa Parent (Menu Utama)</option>
                @foreach($menus as $m)
                <option value="{{ $m->id }}">{{ $m->label }}</option>
                @endforeach
            </select>
            <p class="text-xs text-gray-400 mt-1">Pilih jika ingin membuat sub menu (dropdown)</p>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Tipe Menu</label>
            <div class="flex gap-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="type" value="post" checked class="mr-1"> Halaman (Post/Page)
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="type" value="link" class="mr-1"> Link Eksternal
                </label>
            </div>
        </div>
        
        <div id="post_select" class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Pilih Halaman</label>
            <select name="post_id" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                @foreach($posts as $post)
                <option value="{{ $post->id }}">{{ $post->title }} ({{ $post->post_type }})</option>
                @endforeach
            </select>
        </div>
        
        <div id="link_input" class="mb-4 hidden">
            <label class="block text-gray-700 font-medium mb-2">URL / Link</label>
            <input type="text" name="url" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="https://...">
            <p class="text-xs text-gray-400 mt-1">Contoh: https://facebook.com/ponpes atau /kontak</p>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Urutan</label>
            <input type="number" name="order" value="0" class="w-32 border border-gray-300 rounded-lg px-4 py-2">
            <p class="text-xs text-gray-400 mt-1">Semakin kecil angka, semakin atas posisinya</p>
        </div>
        
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" checked class="mr-2">
                <span class="text-gray-700">Aktif (ditampilkan di menu)</span>
            </label>
        </div>
        
        <div class="flex gap-3">
            <button type="submit" class="bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                <i class="fas fa-save mr-2"></i> Simpan
            </button>
            <a href="{{ route('admin.menus.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    document.querySelectorAll('input[name="type"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'post') {
                document.getElementById('post_select').classList.remove('hidden');
                document.getElementById('link_input').classList.add('hidden');
            } else {
                document.getElementById('post_select').classList.add('hidden');
                document.getElementById('link_input').classList.remove('hidden');
            }
        });
    });
</script>
@endsection