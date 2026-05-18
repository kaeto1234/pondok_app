@extends('layouts.admin')
@section('title', 'Edit Absensi Santri')
@section('content')

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('guru.absensi.rekap', ['jadwal_id' => $absensiGuru->jadwal_mengajar_id]) }}"
            class="text-gray-500 hover:text-[#1e3a5f]">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Absensi Santri</h1>
            <p class="text-gray-500 text-sm">
                {{ $absensiGuru->jadwalMengajar->kurikulum->mataPelajaran->nama_mapel }} -
                {{ $absensiGuru->jadwalMengajar->kurikulum->tingkatDiniyah->nama_tingkat }} |
                Pertemuan ke-{{ $absensiGuru->pertemuan_ke }} |
                {{ $absensiGuru->tanggal->format('d M Y') }}
            </p>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('guru.absensi.update-santri', $absensiGuru->id) }}">
        @csrf @method('PUT')

        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h2 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-users mr-2 text-[#1e3a5f]"></i>
                    Daftar Absensi Santri
                </h2>
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

            @forelse($absensiGuru->absensiSantri as $as)
                <div class="flex flex-col md:flex-row md:items-center gap-3 py-3 border-b last:border-0">
                    <div class="w-8 h-8 bg-[#1e3a5f] rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white text-xs font-bold">
                            {{ strtoupper(substr($as->santriTingkat->santri->nama_lengkap, 0, 1)) }}
                        </span>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-sm text-gray-800">{{ $as->santriTingkat->santri->nama_lengkap }}</p>
                        <p class="text-xs text-gray-400">NIS: {{ $as->santriTingkat->santri->nis }}</p>
                    </div>
                    <div class="flex gap-3 flex-wrap">
                        @foreach (['hadir' => 'green', 'sakit' => 'blue', 'izin' => 'yellow', 'alpha' => 'red'] as $val => $color)
                            <label class="flex items-center gap-1 text-xs cursor-pointer">
                                <input type="radio" name="absensi[{{ $as->id }}][status]"
                                    value="{{ $val }}" class="santri-status accent-{{ $color }}-600"
                                    {{ $as->status == $val ? 'checked' : '' }}>
                                <span
                                    class="text-{{ $color }}-700 font-medium capitalize">{{ ucfirst($val) }}</span>
                            </label>
                        @endforeach
                    </div>
                    <div class="md:w-48">
                        <input type="text" name="absensi[{{ $as->id }}][keterangan]"
                            value="{{ $as->keterangan }}" class="w-full border rounded px-2 py-1 text-xs text-gray-600"
                            placeholder="Keterangan...">
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400 py-6">Belum ada data absensi santri.</p>
            @endforelse
        </div>

        {{-- Santri Tambahan --}}
        @if ($santriTambahan->count() > 0)
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">
                    <i class="fas fa-user-plus mr-2 text-orange-500"></i>
                    Santri Belum Terabsen
                    <span class="text-sm font-normal text-gray-500">({{ $santriTambahan->count() }} santri)</span>
                </h2>
                @foreach ($santriTambahan as $st)
                    <div class="flex flex-col md:flex-row md:items-center gap-3 py-3 border-b last:border-0">
                        <div class="w-8 h-8 bg-orange-400 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-xs font-bold">
                                {{ strtoupper(substr($st->santri->nama_lengkap, 0, 1)) }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-sm text-gray-800">{{ $st->santri->nama_lengkap }}</p>
                            <p class="text-xs text-gray-400">NIS: {{ $st->santri->nis }}</p>
                        </div>
                        <input type="hidden" name="tambahan[{{ $loop->index }}][santri_tingkat_id]"
                            value="{{ $st->id }}">
                        <div class="flex gap-3 flex-wrap">
                            @foreach (['hadir' => 'green', 'sakit' => 'blue', 'izin' => 'yellow', 'alpha' => 'red'] as $val => $color)
                                <label class="flex items-center gap-1 text-xs cursor-pointer">
                                    <input type="radio" name="tambahan[{{ $loop->parent->index }}][status]"
                                        value="{{ $val }}" {{ $val == 'alpha' ? 'checked' : '' }}>
                                    <span
                                        class="text-{{ $color }}-700 font-medium capitalize">{{ ucfirst($val) }}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="md:w-48">
                            <input type="text" name="tambahan[{{ $loop->index }}][keterangan]"
                                class="w-full border rounded px-2 py-1 text-xs text-gray-600" placeholder="Keterangan...">
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex gap-3">
            <button type="submit"
                class="bg-[#1e3a5f] text-white px-8 py-2 rounded-lg hover:bg-[#2a4a7a] transition font-semibold">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
            <a href="{{ route('guru.absensi.rekap', ['jadwal_id' => $absensiGuru->jadwal_mengajar_id]) }}"
                class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                Batal
            </a>
        </div>
    </form>

    <script>
        function tandaiSemua(status) {
            document.querySelectorAll('.santri-status').forEach(radio => {
                if (radio.value === status) radio.checked = true;
            });
        }
    </script>
@endsection
