@extends('layouts.admin')
@section('title', 'Input Nilai')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Input Nilai</h1>
        <p class="text-gray-500 text-sm mt-1">Pilih jadwal, jenis ujian, dan tanggal untuk mulai input nilai</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif

    {{-- Form pilih jadwal --}}
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6 max-w-2xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Pilih Jadwal & Ujian</h2>
        <form method="GET" action="{{ route('guru.nilai.create') }}">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jadwal Mengajar</label>
                    <select name="jadwal_id" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                        <option value="">Pilih Jadwal</option>
                        @foreach ($jadwal as $j)
                            <option value="{{ $j->id }}">
                                {{ $j->hari }} - {{ $j->kurikulum->mataPelajaran->nama_mapel }}
                                ({{ $j->kurikulum->tingkatDiniyah->nama_tingkat }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Ujian</label>
                    <select name="jenis_ujian_id" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                        <option value="">Pilih Jenis Ujian</option>
                        @foreach (\App\Models\JenisUjian::all() as $j)
                            <option value="{{ $j->id }}">{{ $j->nama }} (Bobot: {{ $j->bobot }}%)</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Ujian</label>
                    <input type="date" name="tanggal_ujian" value="{{ today()->format('Y-m-d') }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm" required>
                </div>
            </div>
            <button type="submit"
                class="bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition text-sm">
                <i class="fas fa-arrow-right mr-1"></i> Lanjut Input Nilai
            </button>
        </form>
    </div>

    {{-- Shortcut ke rekap --}}
    <div class="bg-white rounded-xl shadow-sm p-6 max-w-2xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Lihat Rekap Nilai</h2>
        <a href="{{ route('guru.nilai.rekap') }}"
            class="inline-flex items-center bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 transition text-sm">
            <i class="fas fa-table mr-2"></i> Lihat Rekap Nilai Semua Santri
        </a>
    </div>
@endsection
