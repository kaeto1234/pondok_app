<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-4 py-8">

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Daftar Jadwal Mengajar</h1>

            <a href="{{ route('admin.guru.absensi.rekap') }}"
               class="text-blue-600 hover:underline">
                Lihat Rekap
            </a>
        </div>

        {{-- Alert Success --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Alert Error --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Jika tidak ada jadwal --}}
        @if($jadwal->isEmpty())

            <div class="bg-yellow-100 border border-yellow-300 text-yellow-700 p-4 rounded">
                Belum ada jadwal mengajar.
            </div>

        @else

            <div class="grid gap-4">

                @foreach($jadwal as $j)

                    <div class="bg-white rounded-lg shadow p-4 flex justify-between items-center">

                        <div>
                            <p class="font-bold text-lg">
                                {{ $j->kurikulum->mapel->nama_mapel ?? '-' }}
                            </p>

                            <p class="text-sm text-gray-600">
                                {{ $j->kurikulum->tingkat->nama_tingkat ?? '-' }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $j->hari }},
                                {{ $j->jam_mulai }} - {{ $j->jam_selesai }}
                                | Ruang {{ $j->ruangan }}
                            </p>
                        </div>

                        <a href="{{ route('admin.guru.absensi.create', $j->id) }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            Input Absensi
                        </a>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</body>
</html>