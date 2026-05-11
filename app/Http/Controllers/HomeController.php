<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;

class HomeController extends Controller
{
    public function index()
    {
        // ========== HERO SECTION (ambil berdasarkan slug) ==========
        $heroTitle = Post::where('slug', 'hero-title')->first();
        $heroSubtitle = Post::where('slug', 'hero-subtitle')->first();
        $heroBtnKiri = Post::where('slug', 'hero-btn-kiri')->first();
        $heroBtnKanan = Post::where('slug', 'hero-btn-kanan')->first();
        $heroIconKiri = Post::where('slug', 'hero-icon-kiri')->first();
        $heroIconKanan = Post::where('slug', 'hero-icon-kanan')->first();

        // ========== STATISTIK ==========
        $statistik = Post::whereHas('category', function($q) {
            $q->where('slug', 'statistik');
        })->where('post_type', 'post')
          ->orderBy('created_at')
          ->get();

        // ========== CTA PPDB ==========
        $ctaTitle = Post::where('slug', 'cta-title')->first();
        $ctaDesc = Post::where('slug', 'cta-desc')->first();
        $ctaButton = Post::where('slug', 'cta-button')->first();

        // ========== SAMBUTAN ==========
        $sambutan = Post::whereHas('category', function($q) {
            $q->where('slug', 'sambutan-pimpinan');
        })->first();

        // ========== PROGRAM UNGGULAN ==========
        $programUnggulan = Post::whereHas('category', function($q) {
            $q->where('slug', 'program-unggulan');
        })->where('post_type', 'post')
          ->whereNotNull('published_at')
          ->orderBy('published_at', 'desc')
          ->limit(3)
          ->get();

        // ========== FASILITAS PREVIEW ==========
        $fasilitasPreview = Post::whereHas('category', function($q) {
            $q->where('slug', 'fasilitas');
        })->where('post_type', 'post')
          ->whereNotNull('published_at')
          ->orderBy('published_at', 'desc')
          ->limit(4)
          ->get();

        // ========== BERITA TERBARU ==========
        $beritaTerbaru = Post::whereHas('category', function($q) {
            $q->where('slug', 'berita');
        })->where('post_type', 'post')
          ->whereNotNull('published_at')
          ->orderBy('published_at', 'desc')
          ->limit(3)
          ->get();

        return view('home', compact(
            'heroTitle', 'heroSubtitle', 'heroBtnKiri', 'heroBtnKanan', 
            'heroIconKiri', 'heroIconKanan', 'statistik', 
            'ctaTitle', 'ctaDesc', 'ctaButton',
            'sambutan', 'programUnggulan', 'fasilitasPreview', 'beritaTerbaru'
        ));
    }
}