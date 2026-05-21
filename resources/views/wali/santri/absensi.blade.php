@extends('layouts.admin')
@section('title', 'Absensi Santri')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Absensi Santri</h1>
        <p class="text-gray-500 text-sm">
            {{ $santri?->nama_lengkap ?? '-' }} |
            {{ $santriTingkat?->tingkat->nama_tingkat ?? '-' }}
        </p>
    </div>

    @if (!$santri)
        <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 px-4 py-3 rounded">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            Data santri belum terhubung ke akun ini. Hubungi admin.
        </div>
    @else
        {{-- Statistik --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
                <p class="text-2xl font-bold text-green-700">{{ $statistik['hadir'] }}</p>
                <p class="text-sm text-green-600">Hadir</p>
            </div>
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
                <p class="text-2xl font-bold text-blue-700">{{ $statistik['sakit'] }}</p>
                <p class="text-sm text-blue-600">Sakit</p>
            </div>
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-center">
                <p class="text-2xl font-bold text-yellow-700">{{ $statistik['izin'] }}</p>
                <p class="text-sm text-yellow-600">Izin</p>
            </div>
            <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                <p class="text-2xl font-bold text-red-700">{{ $statistik['alpha'] }}</p>
                <p class="text-sm text-red-600">Alpha</p>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Mata Pelajaran</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensiList as $a)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3 text-sm">
                                {{ $a->absensiGuru->tanggal->format('d M Y') }}
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-600">
                                {{ $a->absensiGuru->jadwalMengajar->kurikulum->mataPelajaran->nama_mapel ?? '-' }}
                            </td>
                            <td class="px-6 py-3">
                                @php $status = $a->status; @endphp
                                <span
                                    class="px-2 py-1 text-xs rounded-full font-semibold
                        {{ $status == 'hadir'
                            ? 'bg-green-100 text-green-700'
                            : ($status == 'sakit'
                                ? 'bg-blue-100 text-blue-700'
                                : ($status == 'izin'
                                    ? 'bg-yellow-100 text-yellow-700'
                                    : 'bg-red-100 text-red-700')) }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-500">{{ $a->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                Belum ada data absensi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if (method_exists($absensiList, 'hasPages') && $absensiList->hasPages())
                <div class="px-6 py-4 border-t bg-gray-50">{{ $absensiList->links() }}</div>
            @endif
        </div>
    @endif
@endsection
