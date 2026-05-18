<?php

use App\Http\Controllers\Admin\BerkasTahunAjaranController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\JadwalMengajarController;
use App\Http\Controllers\Admin\JenisBerkasController;
use App\Http\Controllers\Admin\KitabController;
use App\Http\Controllers\Admin\KurikulumController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PpdbController as AdminPpdbController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\TingkatDiniyahController;
use App\Http\Controllers\Admin\YayasanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guru\AbsensiGuruController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\NilaiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\Wali\DashboardController as WaliDashboardController;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Route;

// ─── Public ───────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// PPDB Publik
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb.index');
Route::get('/ppdb/daftar', [PpdbController::class, 'daftar'])->name('ppdb.daftar');
Route::post('/ppdb/store', [PpdbController::class, 'store'])->name('ppdb.store');
Route::get('/ppdb/cek-status', [PpdbController::class, 'cekStatus'])->name('ppdb.cek-status');
Route::post('/ppdb/cek-status', [PpdbController::class, 'hasilCekStatus'])->name('ppdb.hasil-cek-status');
Route::get('/ppdb/selesai/{id}', [PpdbController::class, 'selesai'])->name('ppdb.selesai');

// Halaman kategori & detail post
Route::get('/kategori/{slug}', function ($slug) {
    $category = PostCategory::where('slug', $slug)->firstOrFail();
    $posts = Post::where('post_category_id', $category->id)
        ->where('post_type', 'post')
        ->whereNotNull('published_at')
        ->orderBy('published_at', 'desc')
        ->paginate(12);

    return view('category', compact('category', 'posts'));
})->name('category.list');

Route::get('/page/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)->firstOrFail();
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

// ─── Admin ────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth.custom', 'role:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', PostCategoryController::class);
    Route::resource('posts', PostController::class);
    Route::resource('menus', MenuController::class);

    Route::get('/yayasan', [YayasanController::class, 'index'])->name('yayasan.index');
    Route::put('/yayasan', [YayasanController::class, 'update'])->name('yayasan.update');

    // PPDB
    Route::get('/ppdb', [AdminPpdbController::class, 'index'])->name('ppdb.index');
    Route::get('/ppdb/{id}', [AdminPpdbController::class, 'show'])->name('ppdb.show');
    Route::post('/ppdb/{id}/verify', [AdminPpdbController::class, 'verify'])->name('ppdb.verify');
    Route::post('/ppdb/{id}/reject', [AdminPpdbController::class, 'reject'])->name('ppdb.reject');

    // Berkas Tahun Ajaran
    Route::prefix('tahun-ajaran/{tahunAjaranId}/berkas')->name('berkas-tahun-ajaran.')->group(function () {
        Route::get('/', [BerkasTahunAjaranController::class, 'index'])->name('index');
        Route::post('/', [BerkasTahunAjaranController::class, 'store'])->name('store');
        Route::put('/{id}', [BerkasTahunAjaranController::class, 'update'])->name('update');
        Route::delete('/{id}', [BerkasTahunAjaranController::class, 'destroy'])->name('destroy');
        Route::post('/urutan', [BerkasTahunAjaranController::class, 'updateUrutan'])->name('urutan');
    });

    // Tahun Ajaran
    Route::resource('tahun-ajaran', TahunAjaranController::class)->except(['show']);
    Route::post('/tahun-ajaran/{id}/set-active', [TahunAjaranController::class, 'setActive'])->name('tahun-ajaran.set-active');

    // Jenis Berkas
    Route::resource('jenis-berkas', JenisBerkasController::class);

    // Guru
    Route::resource('guru', GuruController::class)->except(['show']);

    // Tingkat Diniyah
    Route::resource('tingkat-diniyah', TingkatDiniyahController::class)
        ->except(['show', 'create', 'edit']);

    // Mata Pelajaran
    Route::resource('mata-pelajaran', MataPelajaranController::class)
        ->except(['show', 'create', 'edit']);

    // Kurikulum
    Route::get('/kurikulum', [KurikulumController::class, 'index'])->name('kurikulum.index');
    Route::post('/kurikulum', [KurikulumController::class, 'store'])->name('kurikulum.store');
    Route::delete('/kurikulum/{id}', [KurikulumController::class, 'destroy'])->name('kurikulum.destroy');

    // Jadwal Mengajar
    Route::get('/jadwal-mengajar', [JadwalMengajarController::class, 'index'])->name('jadwal-mengajar.index');
    Route::post('/jadwal-mengajar', [JadwalMengajarController::class, 'store'])->name('jadwal-mengajar.store');
    Route::delete('/jadwal-mengajar/{id}', [JadwalMengajarController::class, 'destroy'])->name('jadwal-mengajar.destroy');

    // Kitab
    Route::resource('kitab', KitabController::class)->except(['show']);
});

// Guru
Route::prefix('guru')->name('guru.')->middleware(['auth.custom', 'role:guru'])->group(function () {

    // Dashboard Guru
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile', [GuruDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password', [GuruDashboardController::class, 'updatePassword'])->name('password.update');

    // Absensi
    Route::get('/absensi', [AbsensiGuruController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/create/{jadwalId}', [AbsensiGuruController::class, 'create'])->name('absensi.create');
    Route::post('/absensi/store/{jadwalId}', [AbsensiGuruController::class, 'store'])->name('absensi.store');
    Route::get('/absensi/rekap', [AbsensiGuruController::class, 'rekap'])->name('absensi.rekap');
    Route::get('/absensi/{absensiGuruId}/edit-santri', [AbsensiGuruController::class, 'editSantri'])->name('absensi.edit-santri');
    Route::put('/absensi/{absensiGuruId}/edit-santri', [AbsensiGuruController::class, 'updateSantri'])->name('absensi.update-santri');

    // Penilaian
    Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::get('/nilai/input', [NilaiController::class, 'create'])->name('nilai.create');
    Route::post('/nilai/input', [NilaiController::class, 'store'])->name('nilai.store');
    Route::get('/nilai/rekap', [NilaiController::class, 'rekap'])->name('nilai.rekap');
});

// Wali
Route::prefix('wali')->name('wali.')->middleware(['auth.custom', 'role:wali'])->group(function () {

    //Dashboard Wali
    Route::get('/dashboard', [WaliDashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile', [WaliDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password', [WaliDashboardController::class, 'updatePassword'])->name('password.update');
});
