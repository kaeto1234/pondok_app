@extends('layouts.admin')
@section('title', 'Materi Pembelajaran')
@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Materi Pembelajaran</h1>
    <p class="text-gray-500 text-sm mt-1">Upload dan kelola materi untuk santri</p>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Form Upload --}}
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-lg font-semibold mb-4 border-b pb-2">Upload Materi</h2>
        <form method="POST" action="{{ route('guru.materi.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm" required>
                    @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
                    <select name="mapel_id" class="w-full border rounded-lg px-3 py-2 text-sm">
                        <option value="">Pilih Mapel</option>
                        @foreach($mapelList as $m)
                            <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tingkat</label>
                    <select name="tingkat_id" class="w-full border rounded-lg px-3 py-2 text-sm">
                        <option value="">Pilih Tingkat</option>
                        @foreach($tingkatList as $t)
                            <option value="{{ $t->id }}">{{ $t->nama_tingkat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="2"
                        class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('deskripsi') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">File</label>
                    <input type="file" name="file"
                        class="w-full border rounded-lg px-3 py-2 text-sm"
                        accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png,.mp4">
                    <p class="text-xs text-gray-400 mt-1">Maks 10MB. Format: pdf, doc, ppt, xls, jpg, png, mp4</p>
                    @error('file') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit"
                    class="w-full bg-[#1e3a5f] text-white py-2 rounded-lg hover:bg-[#2a4a7a] transition text-sm">
                    <i class="fas fa-upload mr-1"></i> Upload
                </button>
            </div>
        </form>
    </div>

    {{-- Daftar Materi --}}
    <div class="lg:col-span-2 space-y-3">
        @forelse($materi as $m)
        <div class="bg-white rounded-xl shadow-sm p-4 flex items-start justify-between gap-4">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-[#1e3a5f] rounded-lg flex items-center justify-center flex-shrink-0">
                    @php
                        $ext = pathinfo($m->path_file, PATHINFO_EXTENSION);
                        $icon = match($ext) {
                            'pdf'           => 'fa-file-pdf',
                            'doc', 'docx'   => 'fa-file-word',
                            'ppt', 'pptx'   => 'fa-file-powerpoint',
                            'xls', 'xlsx'   => 'fa-file-excel',
                            'jpg','jpeg','png' => 'fa-file-image',
                            'mp4'           => 'fa-file-video',
                            default         => 'fa-file',
                        };
                    @endphp
                    <i class="fas {{ $icon }} text-white text-sm"></i>
                </div>
                <div>
                    <p class="font-semibold text-sm text-gray-800">{{ $m->judul }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ $m->mataPelajaran->nama_mapel ?? '-' }} |
                        {{ $m->tingkat->nama_tingkat ?? '-' }} |
                        {{ $m->diunduh }} diunduh |
                        {{ number_format($m->ukuran_file / 1024, 0) }} KB
                    </p>
                    @if($m->deskripsi)
                        <p class="text-xs text-gray-500 mt-1">{{ $m->deskripsi }}</p>
                    @endif
                    <p class="text-xs text-gray-400 mt-1">{{ $m->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
            <form action="{{ route('guru.materi.destroy', $m->id) }}" method="POST" class="flex-shrink-0">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 text-sm"
                    onclick="return confirm('Yakin hapus materi ini?')">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-sm p-10 text-center">
            <i class="fas fa-folder-open text-4xl text-gray-300 mb-3"></i>
            <p class="text-gray-500">Belum ada materi yang diupload.</p>
        </div>
        @endforelse

        @if($materi->hasPages())
            <div class="mt-4">{{ $materi->links() }}</div>
        @endif
    </div>
</div>
@endsection