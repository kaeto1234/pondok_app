@extends('layouts.admin')
@section('title', 'Edit Guru')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Guru</h1>
        <p class="text-gray-500">Kosongkan password jika tidak ingin mengubah</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 max-w-2xl">
        <form method="POST" action="{{ route('admin.guru.update', $guru->id) }}">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $guru->nama_lengkap) }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm" required>
                    @error('nama_lengkap')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                    <input type="text" name="nip" value="{{ old('nip', $guru->nip) }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm">
                    @error('nip')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk"
                        value="{{ old('tanggal_masuk', $guru->tanggal_masuk?->format('Y-m-d')) }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $guru->telepon) }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email <span
                            class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $guru->email) }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm" required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="username" value="{{ old('username', $guru->user->username ?? '') }}"
                        class="w-full border rounded-lg px-4 py-2 text-sm" required>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <input type="password" name="password" class="w-full border rounded-lg px-4 py-2 text-sm"
                        placeholder="Kosongkan jika tidak diubah">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="is_active" class="w-full border rounded-lg px-4 py-2 text-sm">
                        <option value="1" {{ $guru->is_active ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$guru->is_active ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keahlian / Mata Pelajaran</label>
                    <textarea name="keahlian" rows="2" class="w-full border rounded-lg px-4 py-2 text-sm">{{ old('keahlian', $guru->keahlian) }}</textarea>
                </div>
            </div>
            <div class="flex gap-3 mt-4">
                <button type="submit"
                    class="bg-navy-primary text-white px-6 py-2 rounded-lg hover:bg-navy-hover transition">
                    <i class="fas fa-save mr-1"></i> Update
                </button>
                <a href="{{ route('admin.guru.index') }}"
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">Batal</a>
            </div>
        </form>
    </div>
@endsection
