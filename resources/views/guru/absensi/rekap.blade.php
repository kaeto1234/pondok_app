@extends('layouts.admin')
@section('title', 'Rekap Absensi')
@section('content')

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('guru.absensi.index') }}" class="text-gray-500 hover:text-[#1e3a5f]">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Rekap Absensi</h1>
    </div>

    {{-- Filter Jadwal --}}
    <form method="GET" class="mb-6">
        <div class="flex items-center gap-3">
            <label class="text-sm font-medium text-gray-700">Jadwal:</label>
            <select name="jadwal_id" onchange="this.form.submit()" class="border rounded-lg px-3 py-2 text-sm">
                @foreach ($jadwalList as $j)
                    <option value="{{ $j->id }}" {{ $selectedJadwal == $j->id ? 'selected' : '' }}>
                        {{ $j->hari }} - {{ $j->kurikulum->mataPelajaran->nama_mapel }}
                        ({{ $j->kurikulum->tingkatDiniyah->nama_tingkat }})
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    {{-- Statistik --}}
    @php
        $totalHadir = $rekap->where('status', 'hadir')->count();
        $totalSakit = $rekap->where('status', 'sakit')->count();
        $totalIzin = $rekap->where('status', 'izin')->count();
        $totalAlpha = $rekap->where('status', 'alpha')->count();
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-green-700">{{ $totalHadir }}</p>
            <p class="text-sm text-green-600">Hadir</p>
        </div>
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-blue-700">{{ $totalSakit }}</p>
            <p class="text-sm text-blue-600">Sakit</p>
        </div>
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-yellow-700">{{ $totalIzin }}</p>
            <p class="text-sm text-yellow-600">Izin</p>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
            <p class="text-2xl font-bold text-red-700">{{ $totalAlpha }}</p>
            <p class="text-sm text-red-600">Alpha</p>
        </div>
    </div>

    {{-- Tabel Rekap --}}
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Pertemuan</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status Guru</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Hadir Santri</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Keterangan</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekap as $r)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3 text-sm font-medium">Pertemuan {{ $r->pertemuan_ke }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $r->tanggal->format('d M Y') }}</td>
                        <td class="px-6 py-3">
                            @if ($r->status == 'hadir')
                                <span
                                    class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full font-semibold">Hadir</span>
                            @elseif($r->status == 'sakit')
                                <span
                                    class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full font-semibold">Sakit</span>
                            @elseif($r->status == 'izin')
                                <span
                                    class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full font-semibold">Izin</span>
                            @else
                                <span
                                    class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded-full font-semibold">Alpha</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-600">
                            @if ($r->status == 'hadir')
                                @php
                                    $hadirSantri = $r->absensiSantri->where('status', 'hadir')->count();
                                    $totalSantri = $r->absensiSantri->count();
                                @endphp
                                {{ $hadirSantri }}/{{ $totalSantri }} santri hadir
                            @else
                                <span class="text-gray-400 italic">Tidak ada kelas</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-500">{{ $r->keterangan ?? '-' }}</td>
                        <td class="px-6 py-3">
                            @if ($r->status == 'hadir')
                                <a href="{{ route('guru.absensi.edit-santri', $r->id) }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-edit mr-1"></i> Edit Santri
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data absensi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($rekap->hasPages())
            <div class="px-6 py-4 border-t bg-gray-50">{{ $rekap->links() }}</div>
        @endif
    </div>
@endsection
