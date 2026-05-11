<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Menu;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $totalPosts = Post::count();
        $totalCategories = PostCategory::count();
        $totalMenus = Menu::count();
        
        // Untuk kategori tertentu (bisa pakai where)
        $totalProfil = Post::whereHas('category', function($q) {
            $q->where('slug', 'profil');
        })->count();
        
        $totalKontak = Post::whereHas('category', function($q) {
            $q->where('slug', 'kontak');
        })->count();
        
        $totalAkademik = Post::whereHas('category', function($q) {
            $q->where('slug', 'akademik');
        })->count();
        
        $totalFasilitas = Post::whereHas('category', function($q) {
            $q->where('slug', 'fasilitas');
        })->count();
        
        return view('admin.dashboard', compact(
            'totalPosts', 
            'totalCategories', 
            'totalMenus',
            'totalProfil',
            'totalKontak',
            'totalAkademik',
            'totalFasilitas'
        ));
    }
}