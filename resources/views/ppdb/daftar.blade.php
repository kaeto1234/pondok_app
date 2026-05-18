@extends('layouts.app')

@section('title', 'Form Pendaftaran - PPDB')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="text-sm text-gray-500 mb-6">
            <a href="{{ url('/') }}" class="hover:text-[#166534]">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ url('/ppdb') }}" class="hover:text-[#166534]">PPDB</a>
            <span class="mx-2">/</span>
            <span class="text-[#166534]">Form Pendaftaran</span>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
            <div class="bg-primary px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Formulir Pendaftaran Santri Baru</h1>
                <p class="text-white/80 text-sm">Isi data dengan lengkap dan benar</p>
            </div>

            <form method="POST" action="{{ route('ppdb.store') }}" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                <input type="hidden" name="tahun_ajaran_id" value="{{ $tahunAjaranAktif->id ?? '' }}">
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Data Pribadi -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 border-b pb-2">A. Data Pribadi</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-1">Jenis Kelamin</label>
                            <select name="jenis_kelamin" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                                <option value="">Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                            <textarea name="alamat" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-1">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 border-b pb-2">B. Data Orang Tua / Wali</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-1">Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-1">Pekerjaan Ayah</label>
                            <input type="text" name="pekerjaan_ayah" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-1">Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-1">Pekerjaan Ibu</label>
                            <input type="text" name="pekerjaan_ibu" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-1">No. Telepon Orang Tua</label>
                            <input type="tel" name="telepon_orang_tua" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-1">Email (untuk login wali) <span class="text-red-500">*</span></label>
                            <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                            <p class="text-xs text-gray-400 mt-1">Email ini akan digunakan oleh wali santri untuk login</p>
                        </div>
                    </div>
                </div>

                <!-- Upload Berkas -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 border-b pb-2">C. Upload Berkas</h2>
                    <div class="space-y-3">
                        @if(isset($berkasWajib) && $berkasWajib->count())
                            @foreach($berkasWajib as $berkas)
                            <div>
                                <label class="block text-gray-700 dark:text-gray-300 mb-1">
                                    {{ $berkas->jenisBerkas->nama }}
                                    @if($berkas->is_wajib)
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>
                                <input type="file" name="berkas_{{ $berkas->id }}" 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2"
                                       {{ $berkas->is_wajib ? 'required' : '' }}>
                                <p class="text-xs text-gray-400 mt-1">
                                    Format: {{ $berkas->jenisBerkas->tipe_file }} | 
                                    Maks: {{ number_format($berkas->jenisBerkas->ukuran_maksimal / 1024, 2) }} MB
                                </p>
                            </div>
                            @endforeach
                        @else
                            <p class="text-gray-500">Belum ada konfigurasi berkas untuk periode ini.</p>
                        @endif
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primaryDark transition">Daftar Sekarang</button>
                    <a href="{{ url('/ppdb') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection