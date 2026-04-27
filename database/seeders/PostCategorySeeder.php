<?php
// database/seeders/PostCategorySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PostCategory;

class PostCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Berita', 'slug' => 'berita', 'description' => 'Berita terbaru pondok', 'icon' => 'newspaper'],
            ['name' => 'Kegiatan', 'slug' => 'kegiatan', 'description' => 'Kegiatan santri', 'icon' => 'calendar'],
            ['name' => 'Fasilitas', 'slug' => 'fasilitas', 'description' => 'Fasilitas pondok', 'icon' => 'building'],
            ['name' => 'Profil', 'slug' => 'profil', 'description' => 'Profil pondok', 'icon' => 'info-circle'],
            ['name' => 'Akademik', 'slug' => 'akademik', 'description' => 'Program akademik', 'icon' => 'graduation-cap'],
            ['name' => 'Prestasi', 'slug' => 'prestasi', 'description' => 'Prestasi santri', 'icon' => 'trophy'],
        ];

        foreach ($categories as $cat) {
            PostCategory::create($cat);
        }
    }
}