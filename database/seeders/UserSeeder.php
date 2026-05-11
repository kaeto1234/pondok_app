<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Pastikan role_id 1 (admin) sudah ada di tabel roles
        User::create([
            'username' => 'admin',
            'email' => 'admin@pondok.com',
            'password' => Hash::make('password'),
            'full_name' => 'Admin Pondok',
            'is_active' => true,
            'role_id' => 1, // asumsi role_id 1 = admin
        ]);
    }
}