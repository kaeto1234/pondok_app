<?php

namespace Database\Seeders;

use App\Models\YayasanInfo;
use Illuminate\Database\Seeder;

class YayasanInfoSeeder extends Seeder
{
    public function run()
    {
        YayasanInfo::updateOrCreate(
            ['id' => 1],
            [
                'nama_yayasan' => 'Pondok Pesantren Roudlotut Tullab',
                'alamat' => 'Jl. KH. Abdullah Hasbullah No.8, Krajan, Padang, Kec. Singojuruh, Kabupaten Banyuwangi, Jawa Timur 68464',
                'telepon' => '082241808808',
                'email' => 'roudlotuttullab01@gmail.com',
                'whatsapp' => '6282241808808',
                'facebook' => 'https://www.facebook.com/share/1BEb9zPTTM/',
                'instagram' => 'https://www.instagram.com/ponpes_roudlotuttullab?igsh=MXV5OW1mZGlrOGloNQ==',
                'youtube' => 'https://youtube.com/@roudlotuttullab_channel?si=ZKJrflxOZssaesc_',
                'twitter' => null,
                'google_maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8121876.116135303!2d104.213674529126!3d-6.295261848425474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd151817a2c66a1%3A0xcc758f98582d1e93!2sYayasan%20Pondok%20Pesantren%20Tahfidz%20Raudlotuttulab!5e0!3m2!1sid!2sid!4v1779699405428!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'logo' => null,
                'favicon' => null,
            ]
        );

        $this->command->info('✅ Yayasan info berhasil di-seed!');
    }
}
