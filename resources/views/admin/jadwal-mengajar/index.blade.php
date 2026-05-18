@extends('layouts.admin')
@section('title', 'Jadwal Mengajar')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Jadwal Mengajar</h1>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    {{-- Filter --}}
    <form method="GET" class="mb-6">
        <div class="flex items-center gap-3">
            <label class="text-sm font-medium text-gray-700">Tahun Ajaran:</label>
            <select name="tahun_ajaran_id" onchange="this.form.submit()" class="border rounded-lg px-3 py-2 text-sm">
                @foreach ($tahunAjaranList as $ta)
                    <option value="{{ $ta->id }}" {{ $selectedTahun == $ta->id ? 'selected' : '' }}>
                        {{ $ta->nama_tahun }} {{ $ta->is_active ? '(Aktif)' : '' }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Form Tambah --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Tambah Jadwal</h2>
            <form method="POST" action="{{ route('admin.jadwal-mengajar.store') }}">
                @csrf
                <input type="hidden" name="tahun_ajaran_id" value="{{ $selectedTahun }}">
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Guru</label>
                    <select name="guru_id" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                        <option value="">Pilih Guru</option>
                        @foreach ($guruList as $g)
                            <option value="{{ $g->id }}">{{ $g->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kurikulum (Tingkat - Mapel)</label>
                    <select name="kurikulum_id" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                        <option value="">Pilih Kurikulum</option>
                        @foreach ($kurikulumList as $k)
                            <option value="{{ $k->id }}">
                                {{ $k->tingkatDiniyah->nama_tingkat }} - {{ $k->mataPelajaran->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hari</label>
                    <select name="hari" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                        <option value="">Pilih Hari</option>
                        @foreach ($hariList as $h)
                            <option value="{{ $h }}">{{ $h }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
                        <input type="time" name="jam_mulai" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai</label>
                        <input type="time" name="jam_selesai" class="w-full border rounded-lg px-3 py-2 text-sm"
                            required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ruangan</label>
                    <input type="text" name="ruangan" class="w-full border rounded-lg px-3 py-2 text-sm"
                        placeholder="Contoh: Kelas A">
                </div>
                <button type="submit"
                    class="w-full bg-navy-primary text-white py-2 rounded-lg hover:bg-navy-hover transition text-sm">
                    <i class="fas fa-plus mr-1"></i> Tambahkan
                </button>
            </form>
        </div>

        {{-- Daftar Jadwal --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Hari</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jam</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tingkat - Mapel</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Guru</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Ruangan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwal as $j)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm font-medium">{{ $j->hari }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span class="font-medium">{{ $j->kurikulum->tingkatDiniyah->nama_tingkat }}</span>
                                <span class="text-gray-500">- {{ $j->kurikulum->mataPelajaran->nama_mapel }}</span>
                            </td>
                            <td class="px-4 py-3 text-sm">{{ $j->guru->nama_lengkap }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $j->ruangan ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <form action="{{ route('admin.jadwal-mengajar.destroy', $j->id) }}" method="POST"
                                    class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                        onclick="return confirm('Yakin hapus jadwal ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada jadwal mengajar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
