@extends('layouts.admin')

@section('title', 'Manajemen Tahun Ajaran')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Tahun Ajaran</h1>
        <p class="text-sm text-gray-500 mt-1">
            <i class="fas fa-info-circle mr-1"></i>
            Klik "Aktifkan" untuk mengganti tahun ajaran aktif. Tahun ajaran sebelumnya otomatis dinonaktifkan.
        </p>
    </div>
    <a href="{{ route('admin.tahun-ajaran.create') }}" class="bg-navy-primary text-white px-4 py-2 rounded-lg hover:bg-navy-hover transition">
        <i class="fas fa-plus mr-2"></i> Tambah Tahun Ajaran
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama Tahun</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tanggal Mulai</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tanggal Selesai</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tahunAjaran as $ta)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">{{ $ta->nama_tahun }}</td>
                <td class="px-6 py-4">{{ $ta->tanggal_mulai ? $ta->tanggal_mulai->format('d M Y') : '-' }}</td>
                <td class="px-6 py-4">{{ $ta->tanggal_selesai ? $ta->tanggal_selesai->format('d M Y') : '-' }}</td>
                <td class="px-6 py-4">
                    @if($ta->is_active)
                        <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Aktif</span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-500 rounded-full">Tidak Aktif</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-2 flex-wrap">
                        @if(!$ta->is_active)
                        <form action="{{ route('admin.tahun-ajaran.set-active', $ta->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-green-600 hover:text-green-800 text-sm"
                                onclick="return confirm('Aktifkan tahun ajaran {{ $ta->nama_tahun }}?')">
                                <i class="fas fa-check-circle mr-1"></i> Aktifkan
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('admin.berkas-tahun-ajaran.index', $ta->id) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-folder-open mr-1"></i> Kelola Berkas
                        </a>
                        <a href="{{ route('admin.tahun-ajaran.edit', $ta->id) }}" class="text-yellow-600 hover:text-yellow-800 text-sm">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        @if(!$ta->is_active)
                        <form action="{{ route('admin.tahun-ajaran.destroy', $ta->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                onclick="return confirm('Yakin ingin menghapus tahun ajaran {{ $ta->nama_tahun }}?')">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data tahun ajaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection