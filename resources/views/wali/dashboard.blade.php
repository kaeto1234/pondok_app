@extends('layouts.admin')

@section('title', 'Dashboard Wali')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ session('user_name') }}!</h1>
    <p class="text-gray-500">Pantau perkembangan putra/putri Anda di sini.</p>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<div x-data="{ tab: '{{ session('tab', 'profile') }}' }">
    <div class="flex gap-2 mb-6 border-b">
        <button @click="tab = 'profile'"
            :class="tab === 'profile' ? 'border-b-2 border-[#1e3a5f] text-[#1e3a5f] font-semibold' : 'text-gray-500'"
            class="px-4 py-2 text-sm transition">
            <i class="fas fa-user mr-1"></i> Profil Saya
        </button>
        <button @click="tab = 'santri'"
            :class="tab === 'santri' ? 'border-b-2 border-[#1e3a5f] text-[#1e3a5f] font-semibold' : 'text-gray-500'"
            class="px-4 py-2 text-sm transition">
            <i class="fas fa-child mr-1"></i> Data Santri
        </button>
        <button @click="tab = 'password'"
            :class="tab === 'password' ? 'border-b-2 border-[#1e3a5f] text-[#1e3a5f] font-semibold' : 'text-gray-500'"
            class="px-4 py-2 text-sm transition">
            <i class="fas fa-lock mr-1"></i> Ganti Password
        </button>
    </div>

    {{-- Tab Profil --}}
    <div x-show="tab === 'profile'">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6 text-center">
                <div class="w-24 h-24 bg-[#1e3a5f] rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl font-bold text-white">
                        {{ strtoupper(substr(session('user_name'), 0, 1)) }}
                    </span>
                </div>
                <p class="font-bold text-gray-800">{{ $user->full_name }}</p>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                <span class="inline-block mt-2 px-3 py-1 text-xs bg-purple-100 text-purple-700 rounded-full font-semibold">Wali Santri</span>
            </div>

            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Edit Profil</h2>
                <form method="POST" action="{{ route('wali.profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm" required>
                        </div>
                        @if($orangTua)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telepon Ayah</label>
                            <input type="text" name="telepon_ayah" value="{{ old('telepon_ayah', $orangTua->telepon_ayah) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telepon Ibu</label>
                            <input type="text" name="telepon_ibu" value="{{ old('telepon_ibu', $orangTua->telepon_ibu) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <textarea name="alamat" rows="2"
                                class="w-full border rounded-lg px-4 py-2 text-sm">{{ old('alamat', $orangTua->alamat) }}</textarea>
                        </div>
                        @endif
                    </div>
                    @error('full_name') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    @error('email') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    <button type="submit"
                        class="mt-4 bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition text-sm">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Tab Data Santri --}}
    <div x-show="tab === 'santri'">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Data Santri</h2>
            @if($santri)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Nama Lengkap</p>
                        <p class="font-semibold">{{ $santri->nama_lengkap }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">NIS</p>
                        <p class="font-semibold">{{ $santri->nis }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Tempat, Tanggal Lahir</p>
                        <p class="font-semibold">
                            {{ $santri->tempat_lahir ?? '-' }},
                            {{ $santri->tanggal_lahir ? $santri->tanggal_lahir->format('d M Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-500">Jenis Kelamin</p>
                        <p class="font-semibold">{{ $santri->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Status</p>
                        <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                            {{ ucfirst($santri->status) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-gray-500">Alamat</p>
                        <p class="font-semibold">{{ $santri->alamat ?? '-' }}</p>
                    </div>
                </div>
            @else
                <p class="text-gray-500 text-sm">Data santri belum tersedia.</p>
            @endif
        </div>
    </div>

    {{-- Tab Ganti Password --}}
    <div x-show="tab === 'password'">
        <div class="max-w-lg bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Ganti Password</h2>
            <form method="POST" action="{{ route('wali.password.update') }}">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                        <input type="password" name="password_lama"
                            class="w-full border rounded-lg px-4 py-2 text-sm" required>
                        @error('password_lama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input type="password" name="password_baru"
                            class="w-full border rounded-lg px-4 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" name="password_baru_confirmation"
                            class="w-full border rounded-lg px-4 py-2 text-sm" required>
                        @error('password_baru') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <button type="submit"
                    class="mt-4 bg-[#1e3a5f] text-white px-6 py-2 rounded-lg hover:bg-[#2a4a7a] transition text-sm">
                    <i class="fas fa-key mr-1"></i> Ganti Password
                </button>
            </form>
        </div>
    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
@endsection