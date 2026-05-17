<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Riwayat Absensi</h1>
            <a href="{{ route('guru.absensi.index') }}" class="text-blue-600 hover:underline">← Kembali</a>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Mapel</th>
                        <th class="px-4 py-2 text-left">Kelas</th>
                        <th class="px-4 py-2 text-left">Pertemuan</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absensi as $a)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ date('d/m/Y', strtotime($a->tanggal)) }}</td>
                        <td class="px-4 py-2">{{ $a->jadwalMengajar->kurikulum->mapel->nama_mapel ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $a->jadwalMengajar->kurikulum->tingkat->nama_tingkat ?? '-' }}</td>
                        <td class="px-4 py-2">Ke-{{ $a->pertemuan_ke }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 rounded text-xs
                                @if($a->status == 'hadir') bg-green-100 text-green-700
                                @elseif($a->status == 'sakit') bg-yellow-100 text-yellow-700
                                @elseif($a->status == 'izin') bg-blue-100 text-blue-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst($a->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada data absensi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $absensi->links() }}
        </div>
    </div>
</body>
</html>