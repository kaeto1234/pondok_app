<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Input Absensi</h1>
        
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="bg-gray-100 p-4 rounded mb-4">
            <p><strong>Mapel:</strong> {{ $jadwal->kurikulum->mapel->nama_mapel ?? '-' }}</p>
            <p><strong>Kelas:</strong> {{ $jadwal->kurikulum->tingkat->nama_tingkat ?? '-' }}</p>
            <p><strong>Waktu:</strong> {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
        </div>
        
        <form method="POST" action="{{ route('guru.absensi.store', $jadwal->id) }}">
            @csrf
            
            <!-- Tanggal Absensi -->
            <div class="bg-white rounded-lg shadow p-4 mb-4">
                <h2 class="font-bold mb-2">Tanggal Absensi</h2>
                <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" 
                       class="border rounded px-3 py-2 w-64" required>
            </div>
            
            <!-- Absensi Guru -->
            <div class="bg-white rounded-lg shadow p-4 mb-4">
                <h2 class="font-bold mb-2">Absensi Guru</h2>
                <div class="flex flex-wrap gap-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="status_guru" value="hadir" {{ old('status_guru') == 'hadir' ? 'checked' : '' }} required> Hadir
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="status_guru" value="sakit" {{ old('status_guru') == 'sakit' ? 'checked' : '' }}> Sakit
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="status_guru" value="izin" {{ old('status_guru') == 'izin' ? 'checked' : '' }}> Izin
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="status_guru" value="alpha" {{ old('status_guru') == 'alpha' ? 'checked' : '' }}> Alpha
                    </label>
                </div>
                <div class="mt-2">
                    <label class="block text-sm text-gray-600">Keterangan (opsional)</label>
                    <input type="text" name="keterangan_guru" value="{{ old('keterangan_guru') }}" class="w-full border rounded px-3 py-1 mt-1">
                </div>
            </div>
            
            <!-- Absensi Santri -->
            <div class="bg-white rounded-lg shadow p-4">
                <h2 class="font-bold mb-2">Absensi Santri</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2">No</th>
                                <th class="text-left py-2">NIS</th>
                                <th class="text-left py-2">Nama Santri</th>
                                <th class="text-center py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($santriList as $index => $santri)
                            <tr class="border-t">
                                <td class="py-2">{{ $index + 1 }}</td>
                                <td class="py-2">{{ $santri->santri->nis ?? '-' }}</td>
                                <td class="py-2">{{ $santri->santri->nama_lengkap ?? '-' }}</td>
                                <td class="py-2 text-center">
                                    <select name="status_santri[{{ $santri->id }}]" class="border rounded px-2 py-1">
                                        <option value="hadir" {{ old('status_santri.' . $santri->id) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="sakit" {{ old('status_santri.' . $santri->id) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                        <option value="izin" {{ old('status_santri.' . $santri->id) == 'izin' ? 'selected' : '' }}>Izin</option>
                                        <option value="alpha" {{ old('status_santri.' . $santri->id) == 'alpha' ? 'selected' : '' }}>Alpha</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Absensi</button>
                <a href="{{ route('guru.absensi.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded ml-2 hover:bg-gray-400">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>