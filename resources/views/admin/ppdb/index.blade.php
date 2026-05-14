@extends('layouts.admin')

@section('title', 'Manajemen PPDB')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Daftar Pendaftar Baru (PPDB)</h1>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 font-semibold text-gray-700">No. Pendaftaran</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Nama Lengkap</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Periode</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Tanggal Daftar</th>
                    <th class="px-6 py-4 font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-4 font-semibold text-gray-700 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($pendaftarans as $pendaftaran)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-navy-primary">{{ $pendaftaran->no_pendaftaran }}</td>
                    <td class="px-6 py-4">{{ $pendaftaran->nama_lengkap }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $pendaftaran->periodePendaftaran->nama }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $pendaftaran->tanggal_daftar->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4">
                        @if($pendaftaran->status == 'pending')
                            <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full">Pending</span>
                        @elseif($pendaftaran->status == 'diverifikasi')
                            <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Diverifikasi</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.ppdb.show', $pendaftaran->id) }}" 
                           class="text-navy-primary hover:text-navy-hover font-medium text-sm inline-flex items-center">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">Belum ada data pendaftaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pendaftarans->hasPages())
    <div class="px-6 py-4 border-t bg-gray-50">
        {{ $pendaftarans->links() }}
    </div>
    @endif
</div>
@endsection
