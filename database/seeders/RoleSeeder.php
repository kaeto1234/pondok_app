<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'Administrator pondok yang memiliki akses penuh ke sistem',
            ],
            [
                'name' => 'teacher',
                'description' => 'Guru/Ustadz yang dapat mengelola nilai dan absensi',
            ],
            [
                'name' => 'parent',
                'description' => 'Wali santri yang dapat melihat nilai dan absensi anak',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                $role
            );
        }
    }
}