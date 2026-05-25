@extends('layouts.admin')
@section('title', 'Informasi Yayasan')
@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Informasi Yayasan</h1>
        <p class="text-gray-500 text-sm mt-1">Data ini ditampilkan di halaman publik dan footer website</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.yayasan.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Kolom Kiri: Logo & Favicon --}}
            <div class="space-y-6">

                {{-- Logo --}}
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Logo Pesantren</h2>

                    @if ($yayasan?->logo)
                        <div class="mb-4 text-center">
                            <img src="{{ asset('storage/' . $yayasan->logo) }}" alt="Logo"
                                class="h-24 w-auto mx-auto object-contain mb-2 border rounded-lg p-2">
                            <div class="flex items-center justify-center gap-2">
                                <input type="checkbox" name="hapus_logo" id="hapus_logo" value="1">
                                <label for="hapus_logo" class="text-sm text-red-600 cursor-pointer">
                                    <i class="fas fa-trash mr-1"></i> Hapus logo
                                </label>
                            </div>
                        </div>
                    @else
                        <div class="mb-4 text-center bg-gray-50 rounded-lg p-6 border-2 border-dashed border-gray-200">
                            <i class="fas fa-image text-4xl text-gray-300 mb-2"></i>
                            <p class="text-sm text-gray-400">Belum ada logo</p>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ $yayasan?->logo ? 'Ganti Logo' : 'Upload Logo' }}
                        </label>
                        <input type="file" name="logo" accept="image/*"
                            class="w-full border rounded-lg px-3 py-2 text-sm">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, SVG, WebP. Maks 2MB</p>
                    </div>
                </div>

                {{-- Favicon --}}
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Favicon</h2>

                    @if ($yayasan?->favicon)
                        <div class="mb-4 text-center">
                            <img src="{{ asset('storage/' . $yayasan->favicon) }}" alt="Favicon"
                                class="h-12 w-12 mx-auto object-contain mb-2 border rounded p-1">
                            <div class="flex items-center justify-center gap-2">
                                <input type="checkbox" name="hapus_favicon" id="hapus_favicon" value="1">
                                <label for="hapus_favicon" class="text-sm text-red-600 cursor-pointer">
                                    <i class="fas fa-trash mr-1"></i> Hapus favicon
                                </label>
                            </div>
                        </div>
                    @else
                        <div class="mb-4 text-center bg-gray-50 rounded-lg p-4 border-2 border-dashed border-gray-200">
                            <i class="fas fa-globe text-2xl text-gray-300 mb-1"></i>
                            <p class="text-xs text-gray-400">Belum ada favicon</p>
                        </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ $yayasan?->favicon ? 'Ganti Favicon' : 'Upload Favicon' }}
                        </label>
                        <input type="file" name="favicon" accept="image/*"
                            class="w-full border rounded-lg px-3 py-2 text-sm">
                        <p class="text-xs text-gray-400 mt-1">Format: PNG, ICO. Maks 512KB. Ukuran 32x32 atau 64x64</p>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Info Yayasan --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Info Dasar --}}
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Informasi Dasar</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Yayasan</label>
                            <input type="text" name="nama_yayasan"
                                value="{{ old('nama_yayasan', $yayasan?->nama_yayasan) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <textarea name="alamat" rows="3" class="w-full border rounded-lg px-4 py-2 text-sm">{{ old('alamat', $yayasan?->alamat) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                            <input type="text" name="telepon" value="{{ old('telepon', $yayasan?->telepon) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp', $yayasan?->whatsapp) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm" placeholder="628xxxxxxxxxx">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email', $yayasan?->email) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm">
                        </div>
                    </div>
                </div>

                {{-- Media Sosial --}}
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Media Sosial</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fab fa-facebook text-blue-600 mr-1"></i> Facebook
                            </label>
                            <input type="text" name="facebook" value="{{ old('facebook', $yayasan?->facebook) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm" placeholder="https://facebook.com/...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fab fa-instagram text-pink-600 mr-1"></i> Instagram
                            </label>
                            <input type="text" name="instagram" value="{{ old('instagram', $yayasan?->instagram) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm"
                                placeholder="https://instagram.com/...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fab fa-youtube text-red-600 mr-1"></i> YouTube
                            </label>
                            <input type="text" name="youtube" value="{{ old('youtube', $yayasan?->youtube) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm" placeholder="https://youtube.com/...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fab fa-twitter text-sky-500 mr-1"></i> Twitter / X
                            </label>
                            <input type="text" name="twitter" value="{{ old('twitter', $yayasan?->twitter) }}"
                                class="w-full border rounded-lg px-4 py-2 text-sm" placeholder="https://twitter.com/...">
                        </div>
                    </div>
                </div>

                {{-- Google Maps --}}
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Google Maps</h2>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Embed Google Maps</label>
                        <textarea name="google_maps" rows="4" class="w-full border rounded-lg px-4 py-2 text-sm font-mono"
                            placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'>{{ old('google_maps', $yayasan?->google_maps) }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Paste kode embed dari Google Maps (klik Share → Embed a map)
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-6">
            <button type="submit"
                class="bg-[#1e3a5f] text-white px-8 py-2 rounded-lg hover:bg-[#2a4a7a] transition font-semibold">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </form>
@endsection
