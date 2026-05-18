<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuPost;
use App\Models\Post;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // ========== MENU PROFIL (PARENT) ==========
        $profilMenu = Menu::updateOrCreate(
            ['label' => 'Profil'],
            ['parent_id' => null, 'order' => 1, 'is_active' => true]
        );
        
        $subProfil = [
            'Sejarah' => 'sejarah',
            'Visi & Misi' => 'visi-misi',
            'Struktur Organisasi' => 'struktur',
            'Sambutan Pimpinan' => 'sambutan',
        ];
        
        $order = 1;
        foreach ($subProfil as $label => $slug) {
            $post = Post::where('slug', $slug)->first();
            if ($post) {
                $menu = Menu::updateOrCreate(
                    ['label' => $label],
                    ['parent_id' => $profilMenu->id, 'order' => $order++, 'is_active' => true]
                );
                MenuPost::updateOrCreate(
                    ['menu_id' => $menu->id],
                    ['post_id' => $post->id]
                );
            }
        }
        
        // ========== MENU AKADEMIK (PARENT) ==========
        $akademikMenu = Menu::updateOrCreate(
            ['label' => 'Akademik'],
            ['parent_id' => null, 'order' => 2, 'is_active' => true]
        );
        
        // Sub menu Akademik arahkan ke kategori
        $subAkademik = [
            'Program Unggulan' => '/kategori/program-unggulan',
            'Mata Pelajaran' => '/kategori/mata-pelajaran',
        ];
        
        $order = 1;
        foreach ($subAkademik as $label => $url) {
            $menu = Menu::updateOrCreate(
                ['label' => $label],
                ['parent_id' => $akademikMenu->id, 'order' => $order++, 'is_active' => true]
            );
            \App\Models\MenuLink::updateOrCreate(
                ['menu_id' => $menu->id],
                ['url' => $url]
            );
        }
        
        // ========== MENU UTAMA ==========
        
        $mainMenus = [
            ['label' => 'Fasilitas', 'url' => '/kategori/fasilitas', 'order' => 3],
            ['label' => 'Berita', 'url' => '/kategori/berita', 'order' => 4],
        ];
        
        foreach ($mainMenus as $item) {
            $menu = Menu::updateOrCreate(
                ['label' => $item['label']],
                ['parent_id' => null, 'order' => $item['order'], 'is_active' => true]
            );
            \App\Models\MenuLink::updateOrCreate(
                ['menu_id' => $menu->id],
                ['url' => $item['url']]
            );
        }
    }
}