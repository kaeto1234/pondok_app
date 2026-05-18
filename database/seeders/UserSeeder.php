<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@pondok.com',
            'password' => Hash::make('admin123'),
            'full_name' => 'Admin Pondok',
            'is_active' => true,
            'role_id' => 1,
        ]);

        $guruUser = User::create([
            'username' => 'guru',
            'email' => 'guru@pondok.com',
            'password' => Hash::make('guru123'),
            'full_name' => 'Guru Pondok',
            'is_active' => true,
            'role_id' => 2,
        ]);

        Guru::create([
            'user_id' => $guruUser->id,
            'nip' => '198501012010011001',
            'nama_lengkap' => 'Guru Pondok',
            'telepon' => '081234567890',
            'email' => 'guru@pondok.com',
            'keahlian' => 'Fiqih, Nahwu',
            'tanggal_masuk' => '2020-01-01',
            'is_active' => true,
        ]);

        $santriUsers = [
            ['nama' => 'Ahmad Fauzi',      'username' => 'ahmad.fauzi'],
            ['nama' => 'Muhammad Rizki',   'username' => 'muhammad.rizki'],
            ['nama' => 'Abdullah Hasan',   'username' => 'abdullah.hasan'],
            ['nama' => 'Fatimah Zahra',    'username' => 'fatimah.zahra'],
            ['nama' => 'Siti Aisyah',      'username' => 'siti.aisyah'],
        ];

        foreach ($santriUsers as $s) {
            $waliUser = User::create([
                'username' => $s['username'],
                'email' => $s['username'].'@pondok.com',
                'password' => Hash::make('santri123'),
                'full_name' => 'Wali '.$s['nama'],
                'is_active' => true,
                'role_id' => 3,
            ]);

            Santri::create([
                'nis' => '2025'.str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
                'nama_lengkap' => $s['nama'],
                'jenis_kelamin' => in_array($s['nama'], ['Fatimah Zahra', 'Siti Aisyah']) ? 'P' : 'L',
                'status' => 'aktif',
            ]);
        }
    }
}
