@extends('layouts.admin')
@section('title', 'Materi Pembelajaran')
@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Materi Pembelajaran</h1>
    <p class="text-gray-500 text-sm">Download materi dari guru</p>
</div>

{{-- Filter --}}
<form method="GET" class="mb-6">
    <div class="flex items-center gap-3">
        <label class="text-sm font-medium text-gray-700">Mata Pelajaran:</label>
        <select name="mapel_id" onchange="this.form.submit()" class="border rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Mapel</option>
            @foreach($mapelList as $m)
                <option value="{{ $m->id }}" {{ request('mapel_id') == $m->id ? 'selected' : '' }}>
                    {{ $m->nama_mapel }}
                </option>
            @endforeach
        </select>
    </div>
</form>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    @forelse($materi as $m)
    <div class="bg-white rounded-xl shadow-sm p-4">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 bg-[#1e3a5f] rounded-lg flex items-center justify-center flex-shrink-0">
                @php
                    $ext = pathinfo($m->path_file, PATHINFO_EXTENSION);
                    $icon = match($ext) {
                        'pdf'             => 'fa-file-pdf',
                        'doc', 'docx'     => 'fa-file-word',
                        'ppt', 'pptx'     => 'fa-file-powerpoint',
                        'xls', 'xlsx'     => 'fa-file-excel',
                        'jpg','jpeg','png' => 'fa-file-image',
                        'mp4'             => 'fa-file-video',
                        default           => 'fa-file',
                    };
                @endphp
                <i class="fas {{ $icon }} text-white text-sm"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-sm text-gray-800 truncate">{{ $m->judul }}</p>
                <p class="text-xs text-gray-400 mt-0.5">
                    {{ $m->mataPelajaran->nama_mapel ?? '-' }} |
                    {{ number_format($m->ukuran_file / 1024, 0) }} KB
                </p>
                @if($m->deskripsi)
                    <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $m->deskripsi }}</p>
                @endif
                <p class="text-xs text-gray-400 mt-1">
                    <i class="fas fa-download mr-1"></i> {{ $m->diunduh }}x diunduh
                </p>
            </div>
        </div>
        <a href="{{ route('wali.santri.materi.download', $m->id) }}"
            class="mt-3 flex items-center justify-center gap-2 w-full bg-[#1e3a5f] text-white py-2 rounded-lg text-sm hover:bg-[#2a4a7a] transition">
            <i class="fas fa-download"></i> Download
        </a>
    </div>
    @empty
    <div class="col-span-3 bg-white rounded-xl shadow-sm p-10 text-center">
        <i class="fas fa-folder-open text-4xl text-gray-300 mb-3"></i>
        <p class="text-gray-500">Belum ada materi yang tersedia.</p>
    </div>
    @endforelse
</div>

@if($materi->hasPages())
    <div class="mt-6">{{ $materi->links() }}</div>
@endif
@endsection