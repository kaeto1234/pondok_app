@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Menu</h1>
    <p class="text-gray-500">Mengubah menu navigasi</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form method="POST" action="{{ route('admin.menus.update', $menu->id) }}">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Label Menu</label>
            <input type="text" name="label" value="{{ $menu->label }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#1e3a5f]">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Parent Menu (opsional)</label>
            <select name="parent_id" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                <option value="">Tanpa Parent (Menu Utama)</option>
                @foreach($menus as $m)
                    @if($m->id != $menu->id)
                    <option value="{{ $m->id }}" {{ $menu->parent_id == $m->id ? 'selected' : '' }}>{{ $m->label }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Tipe Menu</label>
            <div class="flex gap-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="type" value="post" {{ $menu->post ? 'checked' : '' }} class="mr-1"> Halaman (Post/Page)
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="type" value="link" {{ $menu->link ? 'checked' : '' }} class="mr-1"> Link Eksternal
                </label>
            </div>
        </div>
        
        <div id="post_select" class="mb-4 {{ $menu->link ? 'hidden' : '' }}">
            <label class="block text-gray-700 font-medium mb-2">Pilih Halaman</label>
            <select name="post_id" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                @foreach($posts as $post)
                <option value="{{ $post->id }}" {{ ($menu->post && $menu->post->post_id == $post->id) ? 'selected' : '' }}>
                    {{ $post->title }} ({{ $post->post_type }})
                </option>
                @endforeach
            </select>
        </div>
        
        <div id="link_input" class="mb-4 {{ $menu->link ? '' : 'hidden' }}">
            <label class="block text-gray-700 font-medium mb-2">URL / Link</label>
            <input type="text" name="url" value="{{ $menu->link->url ?? '' }}" class="w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="https://...">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Urutan</label>
            <input type="number" name="order" value="{{ $menu->order }}" class="w-32 border border-gray-300 rounded-lg px-4 py-2">
        </div>
        
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ $menu->is_active ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700">Aktif (ditampilkan di menu)</span>
            </label>
        </div>
        
        <div class="flex gap-3">
            <button type="submit" class="bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                <i class="fas fa-save mr-2"></i> Update
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