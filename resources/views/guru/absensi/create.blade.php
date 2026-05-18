@extends('layouts.admin')
@section('title', 'Isi Absensi')
@section('content')

<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('guru.absensi.index') }}" class="text-gray-500 hover:text-[#1e3a5f]">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Isi Absensi</h1>
        <p class="text-gray-500 text-sm">
            {{ $jadwal->kurikulum->mataPelajaran->nama_mapel }} -
            {{ $jadwal->kurikulum->tingkatDiniyah->nama_tingkat }} |
            Pertemuan ke-{{ $pertemuanKe }}
        </p>
    </div>
</div>

@if($absensiHariIni)
    <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 px-4 py-3 rounded mb-6">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        Anda sudah mengisi absensi untuk jadwal ini hari ini.
        Status: <strong>{{ ucfirst($absensiHariIni->status) }}</strong>
    </div>
@endif

<form method="POST" action="{{ route('guru.absensi.store', $jadwal->id) }}">
    @csrf

    {{-- Absensi Guru --}}
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">
            <i class="fas fa-user-check mr-2 text-[#1e3a5f]"></i> Kehadiran Saya
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ today()->format('Y-m-d') }}"
                    class="w-full border rounded-lg px-4 py-2 text-sm" required>
                @error('tanggal') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status Kehadiran</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach(['hadir' => ['green', 'check-circle'], 'sakit' => ['blue', 'procedures'], 'izin' => ['yellow', 'clipboard'], 'alpha' => ['red', 'times-circle']] as $val => $conf)
                    <label class="flex items-center gap-2 border rounded-lg px-3 py-2 cursor-pointer hover:bg-gray-50
                        {{ $val == 'hadir' ? 'border-green-300' : ($val == 'sakit' ? 'border-blue-300' : ($val == 'izin' ? 'border-yellow-300' : 'border-red-300')) }}">
                        <input type="radio" name="status" value="{{ $val }}"
                            {{ $val == 'hadir' ? 'checked' : '' }}
                            class="accent-{{ $conf[0] }}-600"
                            onchange="toggleAbsensiSantri(this.value)">
                        <span class="text-sm capitalize text-{{ $conf[0] }}-700 font-medium">
                            <i class="fas fa-{{ $conf[1] }} mr-1"></i> {{ ucfirst($val) }}
                        </span>
                    </label>
                    @endforeach
                </div>
                @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan (Opsional)</label>
                <input type="text" name="keterangan" value="{{ old('keterangan') }}"
                    class="w-full border rounded-lg px-4 py-2 text-sm"
                    placeholder="Contoh: Izin keperluan keluarga">
            </div>
        </div>
    </div>

    {{-- Absensi Santri --}}
    <div id="absensi-santri-section" class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h2 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-users mr-2 text-[#1e3a5f]"></i>
                Absensi Santri
                <span class="text-sm font-normal text-gray-500">({{ $santriList->count() }} santri)</span>
            </h2>
            {{-- Tombol tandai semua --}}
            <div class="flex gap-2">
                <button type="button" onclick="tandaiSemua('hadir')"
                    class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full hover:bg-green-200">
                    Semua Hadir
                </button>
                <button type="button" onclick="tandaiSemua('alpha')"
                    class="text-xs bg-red-100 text-red-700 px-3 py-1 rounded-full hover:bg-red-200">
                    Semua Alpha
                </button>
            </div>
        </div>

        @forelse($santriList as $st)
        <div class="flex flex-col md:flex-row md:items-center gap-3 py-3 border-b last:border-0">
            <div class="w-8 h-8 bg-[#1e3a5f] rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-white text-xs font-bold">{{ strtoupper(substr($st->santri->nama_lengkap, 0, 1)) }}</span>
            </div>
            <div class="flex-1">
                <p class="font-medium text-sm text-gray-800">{{ $st->santri->nama_lengkap }}</p>
                <p class="text-xs text-gray-400">NIS: {{ $st->santri->nis }}</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                @foreach(['hadir' => 'green', 'sakit' => 'blue', 'izin' => 'yellow', 'alpha' => 'red'] as $val => $color)
                <label class="flex items-center gap-1 text-xs cursor-pointer">
                    <input type="radio" name="absensi[{{ $st->id }}][status]"
                        value="{{ $val }}"
                        class="santri-status accent-{{ $color }}-600"
                        {{ $val == 'hadir' ? 'checked' : '' }}>
                    <span class="text-{{ $color }}-700 font-medium capitalize">{{ ucfirst($val) }}</span>
                </label>
                @endforeach
            </div>
            <div class="md:w-48">
                <input type="text" name="absensi[{{ $st->id }}][keterangan]"
                    class="w-full border rounded px-2 py-1 text-xs text-gray-600"
                    placeholder="Keterangan...">
            </div>
        </div>
        @empty
        <p class="text-center text-gray-400 py-6">Belum ada santri di tingkat ini.</p>
        @endforelse
    </div>

    @if(!$absensiHariIni)
    <div class="flex gap-3">
        <button type="submit"
            class="bg-[#1e3a5f] text-white px-8 py-2 rounded-lg hover:bg-[#2a4a7a] transition font-semibold">
            <i class="fas fa-save mr-2"></i> Simpan Absensi
        </button>
        <a href="{{ route('guru.absensi.index') }}"
            class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
            Batal
        </a>
    </div>
    @endif
</form>

<script>
function toggleAbsensiSantri(status) {
    const section = document.getElementById('absensi-santri-section');
    if (status === 'hadir') {
        section.style.opacity = '1';
        section.querySelectorAll('input').forEach(i => i.disabled = false);
    } else {
        section.style.opacity = '0.5';
        section.querySelectorAll('input').forEach(i => i.disabled = true);
    }
}

function tandaiSemua(status) {
    document.querySelectorAll('.santri-status').forEach(radio => {
        if (radio.value === status) radio.checked = true;
    });
}
</script>
@endsection