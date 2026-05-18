@extends('layouts.admin')
@section('title', 'Input Nilai Santri')
@section('content')

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('guru.nilai.index') }}" class="text-gray-500 hover:text-[#1e3a5f]">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Input Nilai</h1>
            <p class="text-gray-500 text-sm">
                {{ $jadwal->kurikulum->mataPelajaran->nama_mapel }} -
                {{ $jadwal->kurikulum->tingkatDiniyah->nama_tingkat }} |
                {{ $jenisUjian->nama }} (Bobot {{ $jenisUjian->bobot }}%)
            </p>
        </div>
    </div>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('guru.nilai.store') }}">
        @csrf
        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
        <input type="hidden" name="jenis_ujian_id" value="{{ $jenisUjian->id }}">
        <input type="hidden" name="tanggal_ujian" value="{{ request('tanggal_ujian') }}">

        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            <div class="bg-[#0f2b4a] text-white px-6 py-3 flex justify-between items-center">
                <span class="font-semibold">Daftar Nilai Santri</span>
                <span class="text-xs text-white/70">{{ $santriList->count() }} santri | Tanggal:
                    {{ \Carbon\Carbon::parse(request('tanggal_ujian'))->format('d M Y') }}</span>
            </div>

            <div class="p-4">
                {{-- Legend konversi --}}
                <div class="flex gap-3 mb-4 flex-wrap">
                    @foreach ([['A', '90-100', 'green'], ['B', '80-89', 'blue'], ['C', '70-79', 'yellow'], ['D', '60-69', 'orange'], ['E', '<60', 'red']] as $k)
                        <span
                            class="px-2 py-1 text-xs bg-{{ $k[2] }}-100 text-{{ $k[2] }}-700 rounded-full">
                            {{ $k[0] }} = {{ $k[1] }}
                        </span>
                    @endforeach
                </div>

                @forelse($santriList as $st)
                    <div class="flex flex-col md:flex-row md:items-center gap-3 py-3 border-b last:border-0">
                        <div class="w-8 h-8 bg-[#1e3a5f] rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-xs font-bold">
                                {{ strtoupper(substr($st->santri->nama_lengkap, 0, 1)) }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-sm text-gray-800">{{ $st->santri->nama_lengkap }}</p>
                            <p class="text-xs text-gray-400">NIS: {{ $st->santri->nis }}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <input type="number" name="nilai[{{ $st->id }}]" id="nilai_{{ $st->id }}"
                                    value="{{ $nilaiExisting[$st->id] ?? '' }}" min="0" max="100"
                                    step="0.5"
                                    class="w-24 border rounded-lg px-3 py-2 text-sm text-center focus:ring-2 focus:ring-[#1e3a5f]"
                                    placeholder="0-100" oninput="updateHuruf({{ $st->id }}, this.value)">
                            </div>
                            <div id="huruf_{{ $st->id }}"
                                class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm
                        {{ isset($nilaiExisting[$st->id]) ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-400' }}">
                                {{ isset($nilaiExisting[$st->id]) ? \App\Http\Controllers\Guru\NilaiController::konversiHuruf($nilaiExisting[$st->id]) : '-' }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-400 py-6">Belum ada santri di tingkat ini.</p>
                @endforelse
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                class="bg-[#1e3a5f] text-white px-8 py-2 rounded-lg hover:bg-[#2a4a7a] transition font-semibold">
                <i class="fas fa-save mr-2"></i> Simpan Nilai
            </button>
            <a href="{{ route('guru.nilai.index') }}"
                class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
        </div>
    </form>

    <script>
        function updateHuruf(id, nilai) {
            const el = document.getElementById('huruf_' + id);
            nilai = parseFloat(nilai);

            let huruf, bgClass, textClass;
            if (isNaN(nilai) || nilai === '') {
                huruf = '-';
                bgClass = 'bg-gray-100';
                textClass = 'text-gray-400';
            } else if (nilai >= 90) {
                huruf = 'A';
                bgClass = 'bg-green-100';
                textClass = 'text-green-700';
            } else if (nilai >= 80) {
                huruf = 'B';
                bgClass = 'bg-blue-100';
                textClass = 'text-blue-700';
            } else if (nilai >= 70) {
                huruf = 'C';
                bgClass = 'bg-yellow-100';
                textClass = 'text-yellow-700';
            } else if (nilai >= 60) {
                huruf = 'D';
                bgClass = 'bg-orange-100';
                textClass = 'text-orange-700';
            } else {
                huruf = 'E';
                bgClass = 'bg-red-100';
                textClass = 'text-red-700';
            }

            el.textContent = huruf;
            el.className =
                `w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm ${bgClass} ${textClass}`;
        }
    </script>
@endsection
