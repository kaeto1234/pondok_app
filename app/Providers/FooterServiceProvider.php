<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Post;
use App\Models\Menu;

class FooterServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Share data footer ke semua view
        View::composer('*', function ($view) {
            // Ambil data footer dari database
            $footerLogo = Post::where('slug', 'footer-logo-text')->first();
            $footerDesc = Post::where('slug', 'footer-description')->first();
            $footerAlamat = Post::where('slug', 'footer-alamat')->first();
            $footerTelepon = Post::where('slug', 'footer-telepon')->first();
            $footerEmail = Post::where('slug', 'footer-email')->first();
            $footerWhatsapp = Post::where('slug', 'footer-whatsapp')->first();
            $footerFacebook = Post::where('slug', 'footer-facebook')->first();
            $footerInstagram = Post::where('slug', 'footer-instagram')->first();
            $footerYoutube = Post::where('slug', 'footer-youtube')->first();
            $footerTwitter = Post::where('slug', 'footer-twitter')->first();
            
            // Ambil menu untuk tautan cepat
            $quickLinks = Menu::whereNull('parent_id')
                ->where('is_active', true)
                ->orderBy('order')
                ->get();
            
            $view->with(compact(
                'footerLogo', 'footerDesc', 'footerAlamat', 'footerTelepon', 
                'footerEmail', 'footerWhatsapp', 'footerFacebook', 'footerInstagram', 
                'footerYoutube', 'footerTwitter', 'quickLinks'
            ));
        });
    }

    public function register(): void
    {
        //
    }
}