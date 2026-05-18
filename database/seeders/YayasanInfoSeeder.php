<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YayasanInfoSeeder extends Seeder
{
    public function run()
    {
        DB::table('yayasan_info')->insert([
            'nama_yayasan' => 'Ponpes Roudlotut Tullab',
            'alamat' => 'Jl. Pesantren No. 1, Desa Sukamaju, Kec. Ciawi, Kab. Bogor, Jawa Barat 16720',
            'telepon' => '(021) 1234567',
            'email' => 'info@ponpes.sch.id',
            'whatsapp' => '0812-3456-7890',
            'facebook' => 'https://facebook.com/ponpes',
            'instagram' => 'https://instagram.com/ponpes',
            'twitter' => 'https://twitter.com/ponpes',
            'youtube' => 'https://youtube.com/ponpes',
            'google_maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5324.482013356954!2d114.33135687225625!3d-8.487516131424037!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd3fb357923e627%3A0xabf0cda16dfc49ca!2sYayasan%20Minhajut%20Thullab!5e0!3m2!1sid!2sid!4v1779017072959!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}