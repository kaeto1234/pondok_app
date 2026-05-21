@extends('layouts.admin')
@section('title', 'Daftar Santri')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Santri</h1>
        <p class="text-gray-500 text-sm mt-1">Santri pada tingkat yang Anda ajar</p>
    </div>

    {{-- Filter Tingkat --}}
    <form method="GET" class="mb-6">
        <div class="flex items-center gap-3">
            <label class="text-sm font-medium text-gray-700">Tingkat:</label>
            <select name="tingkat_id" onchange="this.form.submit()" class="border rounded-lg px-3 py-2 text-sm">
                @foreach ($tingkatList as $t)
                    <option value="{{ $t->id }}" {{ $selectedTingkat == $t->id ? 'selected' : '' }}>
                        {{ $t->nama_tingkat }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Nama Santri</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">NIS</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Jenis Kelamin</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($santriList as $st)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-3 font-medium text-sm">{{ $st->santri->nama_lengkap }}</td>
                        <td class="px-6 py-3 text-sm text-gray-500">{{ $st->santri->nis }}</td>
                        <td class="px-6 py-3 text-sm text-gray-500">
                            {{ $st->santri->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </td>
                        <td class="px-6 py-3">
                            <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full font-semibold">
                                {{ ucfirst($st->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ route('guru.santri.show', $st->id) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Belum ada santri di tingkat ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
