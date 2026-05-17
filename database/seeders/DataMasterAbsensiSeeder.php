<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TahunAjaran;
use App\Models\TingkatDiniyah;
use App\Models\MataPelajaran;
use App\Models\Kurikulum;
use App\Models\Guru;
use App\Models\JadwalMengajar;
use App\Models\Santri;
use App\Models\SantriTingkat;
use App\Models\User;

class DataMasterAbsensiSeeder extends Seeder
{
    public function run()
    {
        // 1. Tahun Ajaran
        $tahunAjaran = TahunAjaran::updateOrCreate(
            ['nama_tahun' => '2025/2026'],
            [
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2026-06-30',
                'is_active' => true,
            ]
        );

        // 2. Tingkat Diniyah
        $tingkatUla1 = TingkatDiniyah::updateOrCreate(
            ['nama_tingkat' => 'Ula 1'],
            [
                'urutan' => 1,
                'is_active' => true
            ]
        );

        // 3. Mata Pelajaran
        $mapel = MataPelajaran::updateOrCreate(
            ['nama_mapel' => 'Tauhid'],
            [
                'deskripsi' => 'Ilmu Tauhid dasar',
                'is_active' => true
            ]
        );

        // 4. Kurikulum
        $kurikulum = Kurikulum::updateOrCreate(
            [
                'tahun_ajaran_id' => $tahunAjaran->id,
                'tingkat_diniyah_id' => $tingkatUla1->id,
                'mata_pelajaran_id' => $mapel->id,
            ],
            [
                'urutan' => 1,
                'is_active' => true,
            ]
        );

        // 5. User Guru
        $userGuru = User::updateOrCreate(
            ['username' => 'guru1'],
            [
                'email' => 'guru1@example.com',
                'password' => bcrypt('password'),
                'full_name' => 'Guru 1',
                'is_active' => true,
                'role_id' => 2,
            ]
        );

        // 6. Guru
        $guru = Guru::updateOrCreate(
            ['user_id' => $userGuru->id],
            [
                'nip' => '198001012010011001',
                'nama_lengkap' => 'Ustadz Ahmad',
                'telepon' => '08123456789',
                'is_active' => true,
            ]
        );

        // 7. Jadwal Mengajar
        JadwalMengajar::updateOrCreate(
            [
                'tahun_ajaran_id' => $tahunAjaran->id,
                'kurikulum_id' => $kurikulum->id,
                'guru_id' => $guru->id,
                'hari' => 'Senin',
            ],
            [
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:00:00',
                'ruangan' => 'Ruang 101',
                'is_active' => true,
            ]
        );

        // 8. Santri
        $santri = Santri::updateOrCreate(
            ['nis' => '2025001'],
            [
                'nama_lengkap' => 'Ahmad Faiz',
                'tempat_lahir' => 'Banyuwangi',
                'tanggal_lahir' => '2010-05-15',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Pesantren No. 1',
                'status' => 'aktif',
            ]
        );

        // 9. Santri Tingkat
        SantriTingkat::updateOrCreate(
            [
                'santri_id' => $santri->id,
                'tahun_ajaran_id' => $tahunAjaran->id,
            ],
            [
                'tingkat_id' => $tingkatUla1->id,
                'tanggal_mulai' => '2025-07-01',
                'status' => 'aktif',
            ]
        );

        $this->command->info('✅ Data master absensi berhasil ditambahkan!');
    }
}