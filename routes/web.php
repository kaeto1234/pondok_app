<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\Guru\AbsensiGuruController;
use App\Http\Controllers\Admin\PpdbController as AdminPpdbController;




use App\Models\PostCategory;
use App\Models\Post;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Categories (Kategori)
    Route::resource('categories', PostCategoryController::class);

    // Posts (Semua konten)
    Route::resource('posts', PostController::class);

    // Menus (Menu Navigasi)
    Route::resource('menus', MenuController::class);

    // PPDB Admin
    Route::get('/ppdb', [AdminPpdbController::class, 'index'])->name('ppdb.index');
    Route::get('/ppdb/{id}', [AdminPpdbController::class, 'show'])->name('ppdb.show');
    Route::post('/ppdb/{id}/verify', [AdminPpdbController::class, 'verify'])->name('ppdb.verify');
    Route::post('/ppdb/{id}/reject', [AdminPpdbController::class, 'reject'])->name('ppdb.reject');

    //Absensi
    Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('/absensi', [AbsensiGuruController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/create/{jadwalId}', [AbsensiGuruController::class, 'create'])->name('absensi.create');
    Route::post('/absensi/store/{jadwalId}', [AbsensiGuruController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/rekap', [AbsensiGuruController::class, 'rekap'])->name('absensi.rekap');
});


});

// PPDB
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb.index');
Route::get('/ppdb/daftar', [PpdbController::class, 'daftar'])->name('ppdb.daftar');
Route::post('/ppdb/store', [PpdbController::class, 'store'])->name('ppdb.store');
Route::get('/ppdb/selesai/{id}', [PpdbController::class, 'selesai'])->name('ppdb.selesai');

// Halaman daftar berdasarkan kategori (berita, fasilitas, dll)
Route::get('/kategori/{slug}', function ($slug) {
    $category = PostCategory::where('slug', $slug)->firstOrFail();
    $posts = Post::where('post_category_id', $category->id)
        ->where('post_type', 'post')
        ->whereNotNull('published_at')
        ->orderBy('published_at', 'desc')
        ->paginate(12);
    return view('category', compact('category', 'posts'));
})->name('category.list');

// Halaman detail post (SEMUA konten, baik page maupun post)
Route::get('/page/{slug}', function ($slug) { 
    $post = Post::where('slug', $slug)->firstOrFail();
    
    // Jika ini adalah halaman kategori (post_type = page dan ada kategori terkait)
    $category = PostCategory::where('slug', $slug)->first();
    if ($category) {
        $posts = Post::where('post_category_id', $category->id)
            ->where('post_type', 'post')
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(12);
        return view('category', compact('category', 'posts'));
    }
    
    return view('page', compact('post'));
})->name('page.show');




// Route::prefix('guru')->group(function () {
    
//     Route::get('/absensi', function () {
//         return view('guru.absensi');
//     })->name('guru.absensi');
    
//     Route::get('/nilai', function () {
//         return view('guru.nilai');
//     })->name('guru.nilai');
// });