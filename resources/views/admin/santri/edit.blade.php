@extends('layouts.admin')
@section('title', 'Edit Santri')
@section('content')

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('admin.santri.show', $santri->id) }}" class="text-gray-500 hover:text-[#1e3a5f]">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Edit Santri</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 max-w-2xl">
        <form method="POST" action="{{ route('admin.santri.update', $santri->id) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIS <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nis" value="{{ old('nis', $santri->nis) }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm" required>
                    @error('nis')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $santri->nama_lengkap) }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm" required>
                    @error('nama_lengkap')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $santri->tempat_lahir) }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', $santri->tanggal_lahir?->format('Y-m-d')) }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border rounded-lg px-4 py-2 text-sm" required>
                        <option value="L" {{ $santri->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $santri->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $santri->telepon) }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border rounded-lg px-4 py-2 text-sm" required>
                        <option value="aktif" {{ $santri->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="lulus" {{ $santri->status == 'lulus' ? 'selected' : '' }}>Lulus</option>
                        <option value="keluar" {{ $santri->status == 'keluar' ? 'selected' : '' }}>Keluar</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tingkat Saat Ini</label>
                    <select name="tingkat_id" class="w-full border rounded-lg px-4 py-2 text-sm">
                        <option value="">Tidak Diubah</option>
                        @foreach ($tingkatList as $t)
                            @php $aktif = $santri->santriTingkat->where('status', 'aktif')->first(); @endphp
                            <option value="{{ $t->id }}" {{ $aktif?->tingkat_id == $t->id ? 'selected' : '' }}>
                                {{ $t->nama_tingkat }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" rows="2" class="w-full border rounded-lg px-4 py-2 text-sm">{{ old('alamat', $santri->alamat) }}</textarea>
                </div>
            </div>
            <div class="flex gap-3 mt-4">
                <button type="submit" class="bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
                <a href="{{ route('admin.santri.show', $santri->id) }}"
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">Batal</a>
            </div>
        </form>
    </div>
@endsection
