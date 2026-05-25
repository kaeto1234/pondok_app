<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,        
            UserSeeder::class,        
            YayasanInfoSeeder::class, 
            ContentSeeder::class,     
            MenuSeeder::class,        
            DataMasterSeeder::class,  
        ]);

        $this->command->info('');
        $this->command->info('🎉 Semua seeder berhasil dijalankan!');
        $this->command->info('');
        $this->command->info('Akun Login:');
        $this->command->info('  Admin : admin@pondok.com / admin123');
        $this->command->info('  Guru  : fauzan@pondok.com / guru123');
        $this->command->info('  Wali  : [username]@wali.pondok.com / santri123');
    }
}
