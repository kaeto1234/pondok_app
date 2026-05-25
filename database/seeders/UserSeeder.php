<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\OrangTua;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // ─── ADMIN ───────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@pondok.com'],
            [
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'full_name' => 'Admin Pondok',
                'is_active' => true,
                'role_id' => 1,
            ]
        );

        // ─── GURU ─────────────────────────────────────────────
        $guruData = [
            [
                'full_name' => 'Ustadz Ahmad Fauzan',
                'username' => 'ustadz.fauzan',
                'email' => 'fauzan@pondok.com',
                'nip' => '198501012010011001',
                'keahlian' => 'Fiqih, Ushul Fiqih',
                'tanggal_masuk' => '2024-04-06',
            ],
            [
                'full_name' => 'Ustadz Muhammad Ridwan',
                'username' => 'ustadz.ridwan',
                'email' => 'ridwan@pondok.com',
                'nip' => '198703152012011002',
                'keahlian' => 'Nahwu, Shorof, Balaghoh',
                'tanggal_masuk' => '2024-04-06',
            ],
            [
                'full_name' => 'Ustadz Zainul Arifin',
                'username' => 'ustadz.zainul',
                'email' => 'zainul@pondok.com',
                'nip' => '199001202015011003',
                'keahlian' => 'Tafsir, Hadits',
                'tanggal_masuk' => '2024-06-01',
            ],
            [
                'full_name' => 'Ustadzah Siti Maryam',
                'username' => 'ustadzah.maryam',
                'email' => 'maryam@pondok.com',
                'nip' => '199205102016012001',
                'keahlian' => 'Aqidah, Akhlaq, Tajwid',
                'tanggal_masuk' => '2024-06-01',
            ],
            [
                'full_name' => 'Ustadz Abdul Hakim',
                'username' => 'ustadz.hakim',
                'email' => 'hakim@pondok.com',
                'nip' => '199308182017011004',
                'keahlian' => 'Faroidh, Tarikh Islam',
                'tanggal_masuk' => '2025-01-01',
            ],
        ];

        foreach ($guruData as $g) {
            $user = User::firstOrCreate(
                ['email' => $g['email']],
                [
                    'username' => $g['username'],
                    'password' => Hash::make('guru123'),
                    'full_name' => $g['full_name'],
                    'is_active' => true,
                    'role_id' => 2,
                ]
            );

            Guru::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nip' => $g['nip'],
                    'nama_lengkap' => $g['full_name'],
                    'email' => $g['email'],
                    'telepon' => '0812'.rand(10000000, 99999999),
                    'keahlian' => $g['keahlian'],
                    'tanggal_masuk' => $g['tanggal_masuk'],
                    'is_active' => true,
                ]
            );
        }

        // ─── SANTRI & WALI ────────────────────────────────────
        $santriData = [
            // Putra
            ['nama' => 'Ahmad Zaki Mubarok',     'gender' => 'L', 'ayah' => 'Mubarok Hasan',      'ibu' => 'Siti Aminah',     'ttl' => ['Banyuwangi', '2010-03-15']],
            ['nama' => 'Muhammad Fathur Rahman',  'gender' => 'L', 'ayah' => 'Rahman Efendi',      'ibu' => 'Dewi Rahayu',     'ttl' => ['Jember', '2011-07-22']],
            ['nama' => 'Abdullah Azzam',          'gender' => 'L', 'ayah' => 'Azzam Malik',        'ibu' => 'Fatimah Zahra',   'ttl' => ['Situbondo', '2010-11-08']],
            ['nama' => 'Umar Faruq Al-Anshari',  'gender' => 'L', 'ayah' => 'Faruq Anshori',      'ibu' => 'Nurul Hidayah',   'ttl' => ['Banyuwangi', '2011-02-14']],
            ['nama' => 'Ali Imron Rosyadi',       'gender' => 'L', 'ayah' => 'Rosyadi Hamid',      'ibu' => 'Halimah Tusyadiah', 'ttl' => ['Bondowoso', '2012-05-30']],
            ['nama' => 'Hasan Basri Nugroho',     'gender' => 'L', 'ayah' => 'Nugroho Santoso',    'ibu' => 'Umi Kulsum',      'ttl' => ['Banyuwangi', '2010-09-18']],
            ['nama' => 'Yusuf Qordhawi Putra',   'gender' => 'L', 'ayah' => 'Qordhawi Ibrahim',   'ibu' => 'Rohmah Wati',     'ttl' => ['Malang', '2011-12-25']],
            ['nama' => 'Ibrahim Al-Khalil',       'gender' => 'L', 'ayah' => 'Khalil Mustafa',     'ibu' => 'Zulfa Hanifah',   'ttl' => ['Surabaya', '2012-04-10']],
            ['nama' => 'Idris Maulana',           'gender' => 'L', 'ayah' => 'Maulana Yusuf',      'ibu' => 'Badriyah',        'ttl' => ['Banyuwangi', '2013-01-07']],
            ['nama' => 'Ismail Hadrami',          'gender' => 'L', 'ayah' => 'Hadrami Salim',      'ibu' => 'Masyitoh',        'ttl' => ['Banyuwangi', '2013-08-20']],
            // Putri
            ['nama' => 'Fatimah Az-Zahra',        'gender' => 'P', 'ayah' => 'Zahra Ahmad',        'ibu' => 'Khadijah Binti Khuwailid', 'ttl' => ['Banyuwangi', '2010-06-12']],
            ['nama' => 'Aisyah Nur Rahmah',       'gender' => 'P', 'ayah' => 'Rahmah Basri',       'ibu' => 'Qomariyah',       'ttl' => ['Jember', '2011-04-03']],
            ['nama' => 'Zainab Binti Ahmad',      'gender' => 'P', 'ayah' => 'Ahmad Firdaus',      'ibu' => 'Muthmainnah',     'ttl' => ['Banyuwangi', '2010-10-28']],
            ['nama' => 'Maryam Binti Imran',      'gender' => 'P', 'ayah' => 'Imran Hakim',        'ibu' => 'Asiyah',          'ttl' => ['Situbondo', '2012-02-19']],
            ['nama' => 'Khadijah Al-Kubra',       'gender' => 'P', 'ayah' => 'Kubra Mahfud',       'ibu' => 'Zaenab',          'ttl' => ['Banyuwangi', '2011-08-05']],
            ['nama' => 'Ruqayyah Binti Umar',     'gender' => 'P', 'ayah' => 'Umar Fadhil',        'ibu' => 'Shofiyyah',       'ttl' => ['Bondowoso', '2012-11-14']],
            ['nama' => 'Ummu Kultsum Hasanah',    'gender' => 'P', 'ayah' => 'Hasanah Wahid',      'ibu' => 'Mardhiyah',       'ttl' => ['Banyuwangi', '2013-03-22']],
            ['nama' => 'Hafshah Binti Umar',      'gender' => 'P', 'ayah' => 'Umar Khatab',        'ibu' => 'Hindun',          'ttl' => ['Banyuwangi', '2013-06-11']],
        ];

        foreach ($santriData as $index => $s) {
            $username = Str::slug($s['nama'], '.');
            $email = $username.'@wali.pondok.com';

            // Buat user wali
            $waliUser = User::firstOrCreate(
                ['email' => $email],
                [
                    'username' => $username,
                    'password' => Hash::make('santri123'),
                    'full_name' => 'Wali '.$s['nama'],
                    'is_active' => true,
                    'role_id' => 3,
                ]
            );

            // Buat data santri
            $nis = '2024'.str_pad($index + 1, 4, '0', STR_PAD_LEFT);

            $santri = Santri::firstOrCreate(
                ['nis' => $nis],
                [
                    'nama_lengkap' => $s['nama'],
                    'jenis_kelamin' => $s['gender'],
                    'tempat_lahir' => $s['ttl'][0],
                    'tanggal_lahir' => $s['ttl'][1],
                    'alamat' => 'Kab. Banyuwangi, Jawa Timur',
                    'telepon' => '0813'.str_pad($index + 1, 8, '0', STR_PAD_LEFT),
                    'status' => 'aktif',
                ]
            );

            // Buat data orang tua
            OrangTua::firstOrCreate(
                ['santri_id' => $santri->id],
                [
                    'user_id' => $waliUser->id,
                    'nama_ayah' => $s['ayah'],
                    'nama_ibu' => $s['ibu'],
                    'telepon_ayah' => '0812'.str_pad($index + 1, 8, '0', STR_PAD_LEFT),
                    'telepon_ibu' => '0857'.str_pad($index + 1, 8, '0', STR_PAD_LEFT),
                    'alamat' => 'Kab. Banyuwangi, Jawa Timur',
                ]
            );
        }

        $this->command->info('✅ User berhasil di-seed!');
        $this->command->info('   - Admin : 1 (admin@pondok.com / admin123)');
        $this->command->info('   - Guru  : '.Guru::count().' (password: guru123)');
        $this->command->info('   - Santri: '.Santri::count().' (password wali: santri123)');
    }
}
