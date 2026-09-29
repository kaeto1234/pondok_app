@extends('layouts.admin')
@section('title', 'Manajemen Santri')
@section('content')

<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Santri</h1>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
@endif

{{-- Search & Filter --}}
<form method="GET" class="mb-6 flex gap-3">
    <input type="text" name="search" value="{{ request('search') }}"
        placeholder="Cari nama atau NIS..."
        class="border rounded-lg px-4 py-2 text-sm flex-1 max-w-sm">
    <select name="status" onchange="this.form.submit()" class="border rounded-lg px-3 py-2 text-sm">
        <option value="">Semua Status</option>
        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
        <option value="keluar" {{ request('status') == 'keluar' ? 'selected' : '' }}>Keluar</option>
    </select>
    <button type="submit" class="bg-[#1e3a5f] text-white px-4 py-2 rounded-lg text-sm hover:bg-[#2a4a7a] transition">
        <i class="fas fa-search"></i>
    </button>
</form>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama Santri</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">NIS</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tingkat</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($santri as $s)
            @php $tingkat = $s->santriTingkat->where('status', 'aktif')->first(); @endphp
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-3 font-medium text-sm">{{ $s->nama_lengkap }}</td>
                <td class="px-6 py-3 text-sm text-gray-500">{{ $s->nis }}</td>
                <td class="px-6 py-3 text-sm text-gray-500">{{ $tingkat?->tingkat->nama_tingkat ?? '-' }}</td>
                <td class="px-6 py-3">
                    <span class="px-2 py-1 text-xs rounded-full font-semibold
                        {{ $s->status == 'aktif' ? 'bg-green-100 text-green-700' :
                           ($s->status == 'lulus' ? 'bg-blue-100 text-blue-700' :
                           'bg-red-100 text-red-700') }}">
                        {{ ucfirst($s->status) }}
                    </span>
                </td>
                <td class="px-6 py-3">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.santri.show', $s->id) }}"
                            class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </a>
                        <a href="{{ route('admin.santri.edit', $s->id) }}"
                            class="text-yellow-600 hover:text-yellow-800 text-sm">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        @if($s->status !== 'aktif')
                        <form action="{{ route('admin.santri.destroy', $s->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                onclick="return confirm('Yakin hapus data santri ini?')">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data santri.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($santri->hasPages())
        <div class="px-6 py-4 border-t bg-gray-50">{{ $santri->links() }}</div>
    @endif
</div>
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Santri</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola data santri</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.santri.trash') }}"
            class="bg-red-100 text-red-700 px-4 py-2 rounded-lg hover:bg-red-200 transition">
            <i class="fas fa-trash mr-2"></i> Lihat Trash
        </a>
    </div>
</div>
@endsection