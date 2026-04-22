<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Profil Routes
Route::get('/profil/sejarah', function () {
    return view('profil.sejarah');
})->name('profil.sejarah');

Route::get('/profil/visi-misi', function () {
    return view('profil.visi-misi');
})->name('profil.visi-misi');

Route::get('/profil/struktur', function () {
    return view('profil.struktur');
})->name('profil.struktur');

Route::get('/profil/sambutan', function () {
    return view('profil.sambutan');
})->name('profil.sambutan');


// Akademik Routes
Route::get('/akademik', function () {
    return view('akademik.index');
})->name('akademik.index');

Route::get('/akademik/program', function () {
    return view('akademik.program');
})->name('akademik.program');

Route::get('/akademik/mapel', function () {
    return view('akademik.mapel');
})->name('akademik.mapel');

// Fasilitas routes
Route::get('/fasilitas', function () {
    return view('fasilitas');
})->name('fasilitas');

Route::get('/fasilitas/detail/{slug}', function ($slug) {
    $fasilitas = [
        'masjid' => [
            'title' => 'Masjid',
            'icon' => 'fas fa-mosque',
            'description' => 'Masjid Al-Hikmah adalah masjid utama Pondok Pesantren Roudlotut Tullab. Dengan kapasitas 1000 jamaah, masjid ini dilengkapi dengan pendingin ruangan, sound system yang baik, dan area wudhu yang luas. Digunakan untuk shalat berjamaah, kajian kitab, dan kegiatan keagamaan lainnya.'
        ],
        'asrama' => [
            'title' => 'Asrama',
            'icon' => 'fas fa-bed',
            'description' => 'Asrama pondok terbagi menjadi asrama putra dan asrama putri. Setiap asrama dilengkapi dengan fasilitas kamar tidur yang nyaman, kamar mandi dalam, ruang belajar bersama, dan area bermain. Kapasitas asrama mencapai 300 santri.'
        ],
        'perpustakaan' => [
            'title' => 'Perpustakaan',
            'icon' => 'fas fa-book',
            'description' => 'Perpustakaan pondok memiliki koleksi lebih dari 5000 buku, terdiri dari kitab kuning, buku agama, buku umum, dan referensi lainnya. Perpustakaan buka setiap hari dan dilengkapi dengan ruang baca yang nyaman.'
        ],
        'laboratorium' => [
            'title' => 'Laboratorium',
            'icon' => 'fas fa-flask',
            'description' => 'Laboratorium komputer dan bahasa tersedia untuk menunjang pembelajaran santri. Dilengkapi dengan 30 unit komputer, akses internet, dan perangkat laboratorium bahasa untuk praktik belajar.'
        ],
        'kantin' => [
            'title' => 'Kantin & Dapur Umum',
            'icon' => 'fas fa-utensils',
            'description' => 'Kantin dan dapur umum menyediakan makanan sehat dan bergizi untuk santri setiap hari. Menu makanan bervariasi dan disesuaikan dengan kebutuhan gizi santri.'
        ],
        'klinik' => [
            'title' => 'Klinik Kesehatan',
            'icon' => 'fas fa-hospital-user',
            'description' => 'Klinik kesehatan pondok buka 24 jam untuk melayani santri yang sakit. Dilengkapi dengan dokter dan perawat yang siap melayani, serta apotek kecil untuk obat-obatan dasar.'
        ],
        'lapangan' => [
            'title' => 'Lapangan Olahraga',
            'icon' => 'fas fa-futbol',
            'description' => 'Lapangan olahraga tersedia untuk futsal, basket, voli, dan bulutangkis. Fasilitas ini digunakan untuk kegiatan ekstrakurikuler dan olahraga rutin santri.'
        ],
        'ruang-kelas' => [
            'title' => 'Ruang Kelas',
            'icon' => 'fas fa-chalkboard-user',
            'description' => 'Ruang kelas yang nyaman dengan kapasitas 30 santri per kelas. Setiap kelas dilengkapi dengan papan tulis, meja dan kursi yang nyaman, serta sirkulasi udara yang baik.'
        ],
        'aula' => [
            'title' => 'Aula',
            'icon' => 'fas fa-building',
            'description' => 'Aula serbaguna dengan kapasitas 500 orang digunakan untuk acara pondok, seminar, dan kegiatan besar lainnya. Dilengkapi dengan sound system dan pendingin ruangan.'
        ],
    ];

    if (!isset($fasilitas[$slug])) {
        abort(404);
    }

    return view('fasilitas.detail', $fasilitas[$slug]);
})->name('fasilitas.detail');


// Kontak Routes
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');