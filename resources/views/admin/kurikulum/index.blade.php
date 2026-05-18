@extends('layouts.admin')
@section('title', 'Kurikulum')
@section('content')

    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Kurikulum</h1>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    {{-- Filter Tahun Ajaran --}}
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
            <h2 class="text-lg font-semibold mb-4 border-b pb-2">Tambah ke Kurikulum</h2>
            <form method="POST" action="{{ route('admin.kurikulum.store') }}">
                @csrf
                <input type="hidden" name="tahun_ajaran_id" value="{{ $selectedTahun }}">
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tingkat</label>
                    <select name="tingkat_diniyah_id" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                        <option value="">Pilih Tingkat</option>
                        @foreach ($tingkatan as $t)
                            <option value="{{ $t->id }}">{{ $t->nama_tingkat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                        <option value="">Pilih Mapel</option>
                        @foreach ($mapelList as $m)
                            <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="w-full bg-navy-primary text-white py-2 rounded-lg hover:bg-navy-hover transition text-sm">
                    <i class="fas fa-plus mr-1"></i> Tambahkan
                </button>
            </form>
        </div>

        {{-- Daftar per tingkat --}}
        <div class="lg:col-span-2 space-y-4">
            @forelse($tingkatan as $tingkat)
                @php $kurList = $kurikulum->get($tingkat->id, collect()); @endphp
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="bg-[#0f2b4a] text-white px-4 py-3 flex justify-between items-center">
                        <span class="font-semibold">{{ $tingkat->nama_tingkat }}</span>
                        <span class="text-xs text-white/70">{{ $kurList->count() }} mata pelajaran</span>
                    </div>
                    @if ($kurList->count())
                        <table class="w-full">
                            <tbody>
                                @foreach ($kurList as $kur)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-2 text-sm">{{ $kur->mataPelajaran->nama_mapel }}</td>
                                        <td class="px-4 py-2 text-right">
                                            <form action="{{ route('admin.kurikulum.destroy', $kur->id) }}" method="POST"
                                                class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs"
                                                    onclick="return confirm('Hapus mapel ini dari kurikulum?')">
                                                    <i class="fas fa-times"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-center text-gray-400 text-sm py-4">Belum ada mapel di tingkat ini.</p>
                    @endif
                </div>
            @empty
                <p class="text-gray-500">Belum ada tingkat diniyah.</p>
            @endforelse
        </div>
    </div>
@endsection
