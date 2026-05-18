@extends('layouts.admin')
@section('title', 'Rekap Nilai')
@section('content')

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('guru.nilai.index') }}" class="text-gray-500 hover:text-[#1e3a5f]">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Rekap Nilai</h1>
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

    <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
        <table class="w-full">
            <thead class="bg-[#0f2b4a] text-white">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold sticky left-0 bg-[#0f2b4a]">Nama Santri</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">NIS</th>
                    @foreach ($jenisUjianList as $ju)
                        <th class="px-4 py-3 text-center text-sm font-semibold">
                            {{ $ju->nama }}<br>
                            <span class="text-xs text-white/70">Bobot {{ $ju->bobot }}%</span>
                        </th>
                    @endforeach
                    <th class="px-4 py-3 text-center text-sm font-semibold">Nilai Akhir</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Grade</th>
                </tr>
            </thead>
            <tbody>
                @forelse($santriList as $st)
                    @php
                        $nilaiSantri = $nilaiData->get($st->id, collect());
                        $nilaiAkhir = 0;
                        $totalBobot = 0;

                        foreach ($jenisUjianList as $ju) {
                            $n = $nilaiSantri->where('jenis_ujian_id', $ju->id)->first();
                            if ($n) {
                                $nilaiAkhir += $n->nilai * ($ju->bobot / 100);
                                $totalBobot += $ju->bobot;
                            }
                        }

                        $nilaiAkhir = $totalBobot > 0 ? round($nilaiAkhir, 2) : null;
                    @endphp
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-sm sticky left-0 bg-white">{{ $st->santri->nama_lengkap }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $st->santri->nis }}</td>
                        @foreach ($jenisUjianList as $ju)
                            @php $n = $nilaiSantri->where('jenis_ujian_id', $ju->id)->first(); @endphp
                            <td class="px-4 py-3 text-center">
                                @if ($n)
                                    <div class="flex flex-col items-center">
                                        <span class="font-semibold text-sm">{{ $n->nilai }}</span>
                                        @php $huruf = \App\Http\Controllers\Guru\NilaiController::konversiHuruf($n->nilai); @endphp
                                        <span
                                            class="text-xs px-1.5 py-0.5 rounded
                                {{ $huruf == 'A'
                                    ? 'bg-green-100 text-green-700'
                                    : ($huruf == 'B'
                                        ? 'bg-blue-100 text-blue-700'
                                        : ($huruf == 'C'
                                            ? 'bg-yellow-100 text-yellow-700'
                                            : ($huruf == 'D'
                                                ? 'bg-orange-100 text-orange-700'
                                                : 'bg-red-100 text-red-700'))) }}">
                                            {{ $huruf }}
                                        </span>
                                    </div>
                                @else
                                    <span class="text-gray-300 text-xs">-</span>
                                @endif
                            </td>
                        @endforeach
                        <td class="px-4 py-3 text-center font-bold text-sm">
                            {{ $nilaiAkhir ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if ($nilaiAkhir !== null)
                                @php $hurufAkhir = \App\Http\Controllers\Guru\NilaiController::konversiHuruf($nilaiAkhir); @endphp
                                <span
                                    class="px-3 py-1 rounded-full font-bold text-sm
                            {{ $hurufAkhir == 'A'
                                ? 'bg-green-100 text-green-700'
                                : ($hurufAkhir == 'B'
                                    ? 'bg-blue-100 text-blue-700'
                                    : ($hurufAkhir == 'C'
                                        ? 'bg-yellow-100 text-yellow-700'
                                        : ($hurufAkhir == 'D'
                                            ? 'bg-orange-100 text-orange-700'
                                            : 'bg-red-100 text-red-700'))) }}">
                                    {{ $hurufAkhir }}
                                </span>
                            @else
                                <span class="text-gray-300 text-xs">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ 4 + $jenisUjianList->count() }}" class="px-6 py-8 text-center text-gray-500">
                            Belum ada data santri.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
