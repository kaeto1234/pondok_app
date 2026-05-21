@extends('layouts.admin')
@section('title', 'Nilai Santri')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Nilai Santri</h1>
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
    @elseif(empty($nilaiData) || count($nilaiData) == 0)
        <div class="bg-white rounded-xl shadow-sm p-10 text-center">
            <i class="fas fa-star text-4xl text-gray-300 mb-3"></i>
            <p class="text-gray-500">Belum ada data nilai.</p>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#0f2b4a] text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Mata Pelajaran</th>
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
                    @foreach ($nilaiData as $mapelId => $nilaiPerMapel)
                        @php
                            $namaMapel = $nilaiPerMapel->first()->kurikulum->mataPelajaran->nama_mapel;
                            $nilaiAkhir = 0;
                            $totalBobot = 0;
                            foreach ($jenisUjianList as $ju) {
                                $n = $nilaiPerMapel->where('jenis_ujian_id', $ju->id)->first();
                                if ($n) {
                                    $nilaiAkhir += $n->nilai * ($ju->bobot / 100);
                                    $totalBobot += $ju->bobot;
                                }
                            }
                            $nilaiAkhir = $totalBobot > 0 ? round($nilaiAkhir, 2) : null;
                        @endphp
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-sm">{{ $namaMapel }}</td>
                            @foreach ($jenisUjianList as $ju)
                                @php $n = $nilaiPerMapel->where('jenis_ujian_id', $ju->id)->first(); @endphp
                                <td class="px-4 py-3 text-center">
                                    @if ($n)
                                        @php $huruf = \App\Http\Controllers\Guru\NilaiController::konversiHuruf($n->nilai); @endphp
                                        <span class="font-semibold text-sm">{{ $n->nilai }}</span>
                                        <span
                                            class="ml-1 text-xs px-1.5 py-0.5 rounded
                            {{ $huruf == 'A'
                                ? 'bg-green-100 text-green-700'
                                : ($huruf == 'B'
                                    ? 'bg-blue-100 text-blue-700'
                                    : ($huruf == 'C'
                                        ? 'bg-yellow-100 text-yellow-700'
                                        : ($huruf == 'D'
                                            ? 'bg-orange-100 text-orange-700'
                                            : 'bg-red-100 text-red-700'))) }}">{{ $huruf }}</span>
                                    @else
                                        <span class="text-gray-300">-</span>
                                    @endif
                                </td>
                            @endforeach
                            <td class="px-4 py-3 text-center font-bold text-sm">{{ $nilaiAkhir ?? '-' }}</td>
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
                                            : 'bg-red-100 text-red-700'))) }}">{{ $hurufAkhir }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
