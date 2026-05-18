<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'admin',       'description' => 'Administrator sistem'],
            ['id' => 2, 'name' => 'guru',         'description' => 'Guru / Pengajar'],
            ['id' => 3, 'name' => 'wali',         'description' => 'Wali / Orang tua santri'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);
        }
    }
}