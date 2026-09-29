@extends('layouts.admin')
@section('title', 'Trash Santri')
@section('content')

<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Data Santri Terhapus</h1>
        <p class="text-sm text-gray-500 mt-1">
            <i class="fas fa-info-circle mr-1"></i>
            Data yang terhapus masih bisa di-restore atau dihapus permanen
        </p>
    </div>
    <a href="{{ route('admin.santri.index') }}"
        class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>

@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
        <h2 class="font-semibold text-gray-700">
            <i class="fas fa-trash text-red-500 mr-2"></i> Daftar Santri Terhapus
        </h2>
        <span class="text-xs text-gray-500">Total: {{ $santri->total() }} santri</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">NIS</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tingkat</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Dihapus Pada</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($santri as $s)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">{{ $s->nis }}</td>
                        <td class="px-4 py-3 font-medium text-sm">{{ $s->nama_lengkap }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $s->santriTingkat->first()->tingkat->nama_tingkat ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $s->deleted_at->format('d M Y H:i') }}
                            <span class="text-xs text-gray-400 block">
                                ({{ $s->deleted_at->diffForHumans() }})
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2 justify-center">
                                <form action="{{ route('admin.santri.restore', $s->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800 text-sm"
                                        onclick="return confirm('Restore data santri {{ $s->nama_lengkap }}?')">
                                        <i class="fas fa-undo mr-1"></i> Restore
                                    </button>
                                </form>
                                <form action="{{ route('admin.santri.force-delete', $s->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                        onclick="return confirm('HAPUS PERMANEN data santri {{ $s->nama_lengkap }}? Data tidak bisa dikembalikan!')">
                                        <i class="fas fa-trash mr-1"></i> Hapus Permanen
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-check-circle text-3xl text-green-300 mb-2 block"></i>
                            Tidak ada data yang terhapus.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($santri->hasPages())
        <div class="px-6 py-4 border-t bg-gray-50">{{ $santri->links() }}</div>
    @endif
</div>

@endsection