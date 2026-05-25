<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'admin', 'description' => 'Administrator sistem'],
            ['id' => 2, 'name' => 'guru',  'description' => 'Guru / Pengajar'],
            ['id' => 3, 'name' => 'wali',  'description' => 'Wali / Orang tua santri'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['id' => $role['id']], $role);
        }

        $this->command->info('✅ Role berhasil di-seed!');
    }
}
