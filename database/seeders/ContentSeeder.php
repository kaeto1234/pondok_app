<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run()
    {
        // ========== KATEGORI ==========

        $categories = [
            'profil' => PostCategory::firstOrCreate(
                ['slug' => 'profil'],
                ['name' => 'Profil', 'description' => 'Profil pondok pesantren', 'icon' => 'info-circle']
            ),
            'sambutan' => PostCategory::firstOrCreate(
                ['slug' => 'sambutan-pimpinan'],
                ['name' => 'Sambutan Pimpinan', 'description' => 'Sambutan pimpinan pondok', 'icon' => 'microphone-alt']
            ),
            'akademik' => PostCategory::firstOrCreate(
                ['slug' => 'akademik'],
                ['name' => 'Akademik', 'description' => 'Program akademik pondok', 'icon' => 'graduation-cap']
            ),
            'fasilitas' => PostCategory::firstOrCreate(
                ['slug' => 'fasilitas'],
                ['name' => 'Fasilitas', 'description' => 'Fasilitas pondok pesantren', 'icon' => 'building']
            ),
            'berita' => PostCategory::firstOrCreate(
                ['slug' => 'berita'],
                ['name' => 'Berita', 'description' => 'Berita terbaru pondok', 'icon' => 'newspaper']
            ),
            'program_unggulan' => PostCategory::firstOrCreate(
                ['slug' => 'program-unggulan'],
                ['name' => 'Program Unggulan', 'description' => 'Program unggulan pondok', 'icon' => 'star']
            ),
            'mata_pelajaran' => PostCategory::firstOrCreate(
                ['slug' => 'mata-pelajaran'],
                ['name' => 'Mata Pelajaran', 'description' => 'Mata pelajaran pondok', 'icon' => 'book']
            ),
            'hero' => PostCategory::firstOrCreate(
                ['slug' => 'hero-section'],
                ['name' => 'Hero Section', 'description' => 'Komponen hero section', 'icon' => 'home']
            ),
            'statistik' => PostCategory::firstOrCreate(
                ['slug' => 'statistik'],
                ['name' => 'Statistik', 'description' => 'Statistik pondok', 'icon' => 'chart-line']
            ),
            'cta' => PostCategory::firstOrCreate(
                ['slug' => 'cta-ppdb'],
                ['name' => 'CTA PPDB', 'description' => 'Call to Action PPDB', 'icon' => 'megaphone']
            ),

        ];

        // ========== HERO SECTION ==========

        // Hero Title
        Post::updateOrCreate(
            ['slug' => 'hero-title'],
            [
                'title' => 'Hero Title',
                'content' => 'Pondok Pesantren <br> Roudlotut Tullab',
                'post_type' => 'post',
                'post_category_id' => $categories['hero']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        // Hero Subtitle
        Post::updateOrCreate(
            ['slug' => 'hero-subtitle'],
            [
                'title' => 'Hero Subtitle',
                'content' => 'Mencetak Generasi yang Beriman, Berilmu, dan Berakhlak Mulia',
                'post_type' => 'post',
                'post_category_id' => $categories['hero']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        // Hero Button Kiri (Pelajari Lebih Lanjut)
        Post::updateOrCreate(
            ['slug' => 'hero-btn-kiri'],
            [
                'title' => 'Hero Button Kiri',
                'content' => 'Pelajari Lebih Lanjut|/sejarah|bg-white text-primary',
                'post_type' => 'post',
                'post_category_id' => $categories['hero']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        // Hero Button Kanan (Pendaftaran Santri Baru)
        Post::updateOrCreate(
            ['slug' => 'hero-btn-kanan'],
            [
                'title' => 'Hero Button Kanan',
                'content' => 'Pendaftaran Santri Baru|/ppdb|bg-primaryLight text-white',
                'post_type' => 'post',
                'post_category_id' => $categories['hero']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        // Hero Icon Kiri (Masjid)
        Post::updateOrCreate(
            ['slug' => 'hero-icon-kiri'],
            [
                'title' => 'Hero Icon Kiri',
                'content' => 'fas fa-mosque',
                'post_type' => 'post',
                'post_category_id' => $categories['hero']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        // Hero Icon Kanan (Quran)
        Post::updateOrCreate(
            ['slug' => 'hero-icon-kanan'],
            [
                'title' => 'Hero Icon Kanan',
                'content' => 'fas fa-quran',
                'post_type' => 'post',
                'post_category_id' => $categories['hero']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        // ========== STATISTIK (1 post per item) ==========
        $statistikItems = [
            ['title' => 'Santri Aktif', 'content' => '500+', 'order' => 1],
            ['title' => 'Asatidz', 'content' => '50+', 'order' => 2],
            ['title' => 'Program Unggulan', 'content' => '15+', 'order' => 3],
            ['title' => 'Tahun Berdiri', 'content' => '25+', 'order' => 4],
        ];

        $order = 1;
        foreach ($statistikItems as $item) {
            Post::updateOrCreate(
                ['slug' => 'statistik-'.$order],
                [
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'post_type' => 'post',
                    'post_category_id' => $categories['statistik']->id,
                    'author_id' => 1,
                    'published_at' => now(),
                    'featured_image' => null,
                ]
            );
            $order++;
        }

        // ========== CTA PPDB (masing2 komponen beda post) ==========

        // CTA Title
        Post::updateOrCreate(
            ['slug' => 'cta-title'],
            [
                'title' => 'CTA Title',
                'content' => 'Daftarkan Putra-Putri Anda Sekarang!',
                'post_type' => 'post',
                'post_category_id' => $categories['cta']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        // CTA Description
        Post::updateOrCreate(
            ['slug' => 'cta-desc'],
            [
                'title' => 'CTA Description',
                'content' => 'Bergabunglah bersama kami untuk mencetak generasi yang beriman, berilmu, dan berakhlak mulia.',
                'post_type' => 'post',
                'post_category_id' => $categories['cta']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        // CTA Button
        Post::updateOrCreate(
            ['slug' => 'cta-button'],
            [
                'title' => 'CTA Button',
                'content' => 'Pendaftaran Santri Baru|/ppdb|bg-white text-primary',
                'post_type' => 'post',
                'post_category_id' => $categories['cta']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        // ========== 1. PROFIL (PAGE) ==========

        Post::updateOrCreate(
            ['slug' => 'sejarah'],
            [
                'title' => 'Sejarah Berdirinya Pondok Pesantren Roudlotut Tullab',
                'content' => 'Pondok Pesantren Roudlotut Tullab Padang Singojuruh Banyuwangi didirikan oleh Agus Miftah Farid pada tanggal 6 April 2024...',
                'post_type' => 'page',
                'post_category_id' => $categories['profil']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        Post::updateOrCreate(
            ['slug' => 'visi-misi'],
            [
                'title' => 'Visi & Misi Pondok Pesantren Roudlotut Tullab',
                'content' => "VISI:\nPondok Pesantren Roudlotut Tullab adalah lembaga pendidikan...",
                'post_type' => 'page',
                'post_category_id' => $categories['profil']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        Post::updateOrCreate(
            ['slug' => 'struktur'],
            [
                'title' => 'Struktur Organisasi',
                'content' => '',
                'post_type' => 'page',
                'post_category_id' => $categories['profil']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        // ========== 2. SAMBUTAN (PAGE) ==========

        Post::updateOrCreate(
            ['slug' => 'sambutan'],
            [
                'title' => 'Sambutan Pimpinan',
                'content' => "Assalamu'alaikum Warahmatullahi Wabarakatuh...",
                'post_type' => 'page',
                'post_category_id' => $categories['sambutan']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        // ========== 3. PROGRAM UNGGULAN (POST DETAIL) ==========

        $programUnggulanDetail = [
            [
                'title' => 'Tahfidz Al-Qur\'an',
                'slug' => 'tahfidz',
                'content' => "<h3>Tentang Program</h3><p>Program hafalan 30 juz dengan target 3-5 tahun...</p><h3>Metode</h3><ul><li>Talqin</li><li>Setoran per pekan</li><li>Muroja'ah rutin</li></ul><h3>Prestasi</h3><ul><li>Juara 1 MTQ Kabupaten 2025</li></ul><h3>Jadwal</h3><ul><li>Pagi: 04.30 - 06.00</li><li>Malam: 19.00 - 20.30</li></ul>",
            ],
            [
                'title' => 'Bahasa Arab',
                'slug' => 'bahasa-arab',
                'content' => '<h3>Tentang Program</h3><p>Program intensif bahasa Arab...</p><h3>Metode</h3><ul><li>Immersion</li><li>Percakapan sehari-hari</li><li>Muhadhoroh pekanan</li></ul><h3>Prestasi</h3><ul><li>Juara 1 Pidato Bahasa Arab Provinsi 2025</li></ul><h3>Jadwal</h3><ul><li>Senin-Kamis: 15.00 - 17.00</li></ul>',
            ],
            [
                'title' => 'Kajian Kitab Kuning',
                'slug' => 'kajian-kitab',
                'content' => '<h3>Tentang Program</h3><p>Pembelajaran kitab salaf...</p><h3>Kitab</h3><ul><li>Jurumiyah</li><li>Fathul Qorib</li><li>Tafsir Jalalain</li></ul><h3>Jadwal</h3><ul><li>Malam: 20.00 - 22.00</li></ul>',
            ],
        ];

        foreach ($programUnggulanDetail as $item) {
            Post::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'post_type' => 'post',
                    'post_category_id' => $categories['program_unggulan']->id,
                    'author_id' => 1,
                    'published_at' => now(),
                    'featured_image' => null,
                ]
            );
        }

        // ========== 4. MATA PELAJARAN (POST DETAIL) ==========

        $mapelDetail = [
            [
                'title' => 'Diniyah Ula',
                'slug' => 'diniyah-ula',
                'content' => "<h3>Mata Pelajaran Diniyah Ula</h3><ul><li><strong>Tauhid</strong> - Aqidatul Awam</li><li><strong>Fiqih</strong> - Safinatun Najah</li><li><strong>Nahwu</strong> - Jurumiyah</li><li><strong>Al-Qur'an</strong> - Tahsin & Tahfidz</li></ul><p>Tingkat dasar (setara SD/MI).</p>",
            ],
            [
                'title' => 'Diniyah Wustha',
                'slug' => 'diniyah-wustha',
                'content' => '<h3>Mata Pelajaran Diniyah Wustha</h3><ul><li><strong>Tafsir</strong> - Tafsir Jalalain</li><li><strong>Hadits</strong> - Bulughul Maram</li><li><strong>Fiqih</strong> - Fathul Qorib</li><li><strong>Nahwu</strong> - Imrithi</li><li><strong>Shorof</strong> - Amtsilatut Tashrifiyah</li></ul><p>Tingkat menengah (setara SMP/MTs).</p>',
            ],
        ];

        foreach ($mapelDetail as $item) {
            Post::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'post_type' => 'post',
                    'post_category_id' => $categories['mata_pelajaran']->id,
                    'author_id' => 1,
                    'published_at' => now(),
                    'featured_image' => null,
                ]
            );
        }

        // ========== 5. FASILITAS (PAGE & POST) ==========

        Post::updateOrCreate(
            ['slug' => 'fasilitas'],
            [
                'title' => 'Fasilitas Pondok Pesantren',
                'content' => '',
                'post_type' => 'page',
                'post_category_id' => $categories['fasilitas']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        $fasilitasList = [
            ['title' => 'Masjid', 'slug' => 'masjid', 'content' => 'Masjid utama pondok dengan kapasitas 1000 jamaah.'],
            ['title' => 'Asrama', 'slug' => 'asrama', 'content' => 'Asrama santri putra dan putri dengan fasilitas lengkap.'],
            ['title' => 'Perpustakaan', 'slug' => 'perpustakaan', 'content' => 'Koleksi 5000+ buku agama, umum, dan kitab kuning.'],
            ['title' => 'Laboratorium', 'slug' => 'laboratorium', 'content' => 'Lab komputer dan bahasa.'],
            ['title' => 'Kantin', 'slug' => 'kantin', 'content' => 'Kantin dan dapur umum.'],
            ['title' => 'Klinik Kesehatan', 'slug' => 'klinik', 'content' => 'Klinik 24 jam.'],
            ['title' => 'Lapangan Olahraga', 'slug' => 'lapangan', 'content' => 'Lapangan futsal, basket, voli.'],
            ['title' => 'Ruang Kelas', 'slug' => 'ruang-kelas', 'content' => 'Ruang kelas nyaman.'],
            ['title' => 'Aula', 'slug' => 'aula', 'content' => 'Aula serbaguna.'],
        ];

        foreach ($fasilitasList as $item) {
            Post::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'post_type' => 'post',
                    'post_category_id' => $categories['fasilitas']->id,
                    'author_id' => 1,
                    'published_at' => now(),
                    'featured_image' => null,
                ]
            );
        }

        // ========== 6. BERITA (PAGE & POST) ==========

        Post::updateOrCreate(
            ['slug' => 'berita'],
            [
                'title' => 'Berita Pondok Pesantren',
                'content' => '',
                'post_type' => 'page',
                'post_category_id' => $categories['berita']->id,
                'author_id' => 1,
                'published_at' => now(),
                'featured_image' => null,
            ]
        );

        $beritaList = [
            ['title' => 'Santri Raih Juara 1 Olimpiade Sains', 'slug' => 'santri-raih-juara-1', 'content' => 'Santri berhasil meraih juara 1 Olimpiade Sains.', 'date' => '2026-04-15'],
            ['title' => 'Pesantren Kilat Ramadhan', 'slug' => 'pesantren-kilat', 'content' => 'Kegiatan pesantren kilat Ramadhan.', 'date' => '2026-04-10'],
            ['title' => 'Kerjasama dengan Universitas Al-Azhar', 'slug' => 'kerjasama-al-azhar', 'content' => 'Kerjasama dengan Universitas Al-Azhar.', 'date' => '2026-04-05'],
        ];

        foreach ($beritaList as $item) {
            Post::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'post_type' => 'post',
                    'post_category_id' => $categories['berita']->id,
                    'author_id' => 1,
                    'published_at' => $item['date'],
                    'featured_image' => null,
                ]
            );
        }
    }
}