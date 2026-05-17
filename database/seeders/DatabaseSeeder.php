<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
=======
>>>>>>> 1ddd39dd85bf8fe9b89d4203652d50b98cac69ae
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
<<<<<<< HEAD
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
=======
    public function run()
    {
        $this->call([
            RoleSeeder::class, 
            UserSeeder::class,
            ContentSeeder::class,
            MenuSeeder::class,
            DataMasterAbsensiSeeder::class,     
        ]);
    }
}
>>>>>>> 1ddd39dd85bf8fe9b89d4203652d50b98cac69ae
