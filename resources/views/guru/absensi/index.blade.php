@extends('layouts.admin')
@section('title', 'Absensi Mengajar')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Jadwal Mengajar Saya</h1>
        <p class="text-gray-500 text-sm mt-1">
            <i class="fas fa-calendar-day mr-1"></i>
            Hari ini: {{ now()->isoFormat('dddd, D MMMM Y') }}
        </p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($jadwal as $j)
            <div
                class="bg-white rounded-xl shadow-sm overflow-hidden border {{ $j->hari == now()->locale('id')->isoFormat('dddd') ? 'border-[#1e3a5f]' : 'border-transparent' }}">

                {{-- Header --}}
                <div class="bg-[#0f2b4a] text-white px-4 py-3 flex justify-between items-center">
                    <div>
                        <p class="font-semibold">{{ $j->hari }}</p>
                        <p class="text-xs text-white/70">
                            {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                        </p>
                    </div>
                    @if ($j->hari == now()->locale('id')->isoFormat('dddd'))
                        <span class="text-xs bg-yellow-400 text-gray-800 px-2 py-0.5 rounded-full font-bold">Hari Ini</span>
                    @endif
                </div>

                {{-- Body --}}
                <div class="p-4">
                    <p class="font-semibold text-gray-800">{{ $j->kurikulum->mataPelajaran->nama_mapel }}</p>
                    <p class="text-sm text-gray-500">{{ $j->kurikulum->tingkatDiniyah->nama_tingkat }}</p>
                    <p class="text-xs text-gray-400 mt-1">
                        <i class="fas fa-door-open mr-1"></i> {{ $j->ruangan ?? 'Ruangan belum ditentukan' }}
                    </p>

                    {{-- Status absensi hari ini --}}
                    <div class="mt-3">
                        @if (isset($absensiHariIni[$j->id]))
                            @php $status = $absensiHariIni[$j->id]; @endphp
                            @if ($status == 'hadir')
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full font-semibold">
                                    <i class="fas fa-check mr-1"></i> Sudah Absen - Hadir
                                </span>
                            @elseif($status == 'sakit')
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full font-semibold">
                                    <i class="fas fa-procedures mr-1"></i> Sudah Absen - Sakit
                                </span>
                            @elseif($status == 'izin')
                                <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full font-semibold">
                                    <i class="fas fa-clipboard mr-1"></i> Sudah Absen - Izin
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded-full font-semibold">
                                    <i class="fas fa-times mr-1"></i> Sudah Absen - Alpha
                                </span>
                            @endif
                        @else
                            <span class="px-2 py-1 text-xs bg-gray-100 text-gray-500 rounded-full">
                                <i class="fas fa-clock mr-1"></i> Belum Absen Hari Ini
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Footer --}}
                <div class="px-4 pb-4 flex gap-2">
                    @if (!isset($absensiHariIni[$j->id]))
                        <a href="{{ route('guru.absensi.create', $j->id) }}"
                            class="flex-1 text-center bg-[#1e3a5f] text-white py-2 rounded-lg text-sm hover:bg-[#2a4a7a] transition">
                            <i class="fas fa-clipboard-check mr-1"></i> Isi Absensi
                        </a>
                    @endif
                    <a href="{{ route('guru.absensi.rekap', ['jadwal_id' => $j->id]) }}"
                        class="flex-1 text-center bg-gray-100 text-gray-700 py-2 rounded-lg text-sm hover:bg-gray-200 transition">
                        <i class="fas fa-history mr-1"></i> Rekap
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white rounded-xl shadow-sm p-10 text-center">
                <i class="fas fa-calendar-times text-4xl text-gray-300 mb-3"></i>
                <p class="text-gray-500">Belum ada jadwal mengajar yang ditugaskan.</p>
                <p class="text-gray-400 text-sm mt-1">Hubungi admin untuk pengaturan jadwal.</p>
            </div>
        @endforelse
    </div>
@endsection
