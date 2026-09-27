@extends('layouts.admin')
@section('title', 'Manajemen Guru')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Guru</h1>
        <p class="text-sm text-gray-500 mt-1">
            <i class="fas fa-info-circle mr-1"></i>
            Kelola data guru dan akun login-nya
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- KIRI: FORM TAMBAH GURU --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-6 max-h-[calc(100vh-6rem)] overflow-y-auto">
                <h2 class="text-lg font-bold text-gray-800 mb-4">
                    <i class="fas fa-plus-circle text-navy-primary mr-2"></i> Tambah Guru
                </h2>
                <p class="text-xs text-gray-500 mb-4">Akun login guru akan otomatis dibuat</p>

                <form action="{{ route('admin.guru.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            required>
                        @error('nama_lengkap')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                        <input type="text" name="nip" value="{{ old('nip') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary">
                        @error('nip')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary">
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary">
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Username <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="username" value="{{ old('username') }}"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            required>
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Keahlian / Mata Pelajaran</label>
                        <textarea name="keahlian" rows="2"
                            class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            placeholder="Contoh: Fiqih, Nahwu, Shorof">{{ old('keahlian') }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                            class="flex-1 bg-navy-primary text-white px-4 py-2 rounded-lg hover:bg-navy-hover transition text-sm">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                        <button type="reset"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm">
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- KANAN: TABEL DAFTAR GURU --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
                    <h2 class="font-semibold text-gray-700">
                        <i class="fas fa-chalkboard-teacher text-navy-primary mr-2"></i> Daftar Guru
                    </h2>
                    <span class="text-xs text-gray-500">Total: {{ $gurus->total() }} guru</span>
                </div>

                {{-- Search & Filter --}}
                <div class="px-4 py-3 border-b bg-white flex gap-3">
                    <form method="GET" action="{{ route('admin.guru.index') }}" class="flex-1 flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama, NIP, atau email..."
                            class="flex-1 border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary">
                        <select name="status"
                            class="border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-navy-primary focus:border-navy-primary"
                            onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        <button type="submit"
                            class="bg-navy-primary text-white px-4 py-2 rounded-lg hover:bg-navy-hover transition text-sm">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">NIP</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Email</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Keahlian</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($gurus as $guru)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-sm">{{ $guru->nama_lengkap }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $guru->nip ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $guru->email }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">{{ $guru->keahlian ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        @if ($guru->is_active)
                                            <span
                                                class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Aktif</span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.guru.edit', $guru->id) }}"
                                                class="text-yellow-600 hover:text-yellow-800 text-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.guru.destroy', $guru->id) }}" method="POST"
                                                class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm"
                                                    onclick="return confirm('Yakin hapus guru ini? Akun login juga akan terhapus.')"
                                                    title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                        <i class="fas fa-chalkboard-teacher text-3xl text-gray-300 mb-2 block"></i>
                                        Belum ada data guru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($gurus->hasPages())
                    <div class="px-6 py-4 border-t bg-gray-50">{{ $gurus->links() }}</div>
                @endif
            </div>
        </div>

    </div>
@endsection
