@extends('layouts.admin')
@section('title', 'Manajemen Guru')
@section('content')

    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Guru</h1>
        <a href="{{ route('admin.guru.create') }}"
            class="bg-navy-primary text-white px-4 py-2 rounded-lg hover:bg-navy-hover transition">
            <i class="fas fa-plus mr-2"></i> Tambah Guru
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama Lengkap</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">NIP</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Keahlian</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gurus as $guru)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">{{ $guru->nama_lengkap }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $guru->nip ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $guru->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $guru->keahlian ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if ($guru->is_active)
                                <span
                                    class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Aktif</span>
                            @else
                                <span
                                    class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.guru.edit', $guru->id) }}"
                                    class="text-yellow-600 hover:text-yellow-800 text-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                        onclick="return confirm('Yakin hapus guru ini? Akun login juga akan terhapus.')">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data guru.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($gurus->hasPages())
            <div class="px-6 py-4 border-t bg-gray-50">{{ $gurus->links() }}</div>
        @endif
    </div>
@endsection
