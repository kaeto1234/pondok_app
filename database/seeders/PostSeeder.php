<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua kategori
        $profilCategory = PostCategory::where('slug', 'profil')->first();
        $sambutanCategory = PostCategory::where('slug', 'sambutan')->first();
        $programCategory = PostCategory::where('slug', 'program-unggulan')->first();
        $fasilitasCategory = PostCategory::where('slug', 'fasilitas-preview')->first();
        $beritaCategory = PostCategory::where('slug', 'berita')->first();
        $testimoniCategory = PostCategory::where('slug', 'testimoni')->first();

        $posts = [
            // ========== PROFIL ==========
            [
                'title' => 'Sejarah Berdirinya Pondok Pesantren Roudlotut Tullab',
                'content' => '<p>Pondok Pesantren Roudlotut Tullab Padang Singojuruh Banyuwangi didirikan oleh Agus Miftah Farid pada tanggal 6 April 2024. Berdirinya pondok ini dilatarbelakangi oleh cita-cita luhur untuk membangun lembaga pendidikan Islam yang berfokus pada pembinaan ilmu agama, akhlak mulia, serta mencetak generasi santri yang berpegang teguh pada nilai-nilai keislaman.</p>
                <p>Pada masa awal berdirinya, kegiatan pondok dimulai secara sederhana melalui pengajian kitab kuning sebagai inti pendidikan pesantren. Dari kegiatan ngaji kitab inilah Pondok Pesantren Roudlotut Tullab mulai berkembang sebagai tempat menimba ilmu agama dan pembinaan karakter santri.</p>
                <p>Di bawah asuhan Agus Miftah Farid, pondok terus berkembang baik dalam sistem pendidikan maupun sarana penunjang. Tidak hanya menyelenggarakan pendidikan kepesantrenan melalui madrasah diniyah, pondok juga mengembangkan pendidikan formal sebagai bentuk ikhtiar memadukan ilmu agama dan ilmu umum.</p>
                <p>Seiring perjalanan waktu, Pondok Pesantren Roudlotut Tullab berupaya menjadi lembaga pendidikan yang menjaga tradisi pesantren salaf melalui kajian kitab, sekaligus menjawab kebutuhan zaman melalui pengembangan lembaga pendidikan yang lebih luas. Dengan semangat keilmuan, pengabdian, dan pembinaan akhlakul karimah, pondok ini diharapkan terus melahirkan santri yang berilmu, beradab, dan bermanfaat bagi umat.</p>',
                'post_type' => 'page',
                'post_category_id' => $profilCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'sejarah',
                'featured_image' => null,
            ],
            [
                'title' => 'Visi & Misi Pondok Pesantren Roudlotut Tullab',
                'content' => '<h3>Visi</h3>
                <p>Pondok Pesantren Roudlotut Tullab adalah lembaga pendidikan dan pengajaran islam yang sejak berdirinya tetap mempertahankan konsep salafiyah dengan menganut Thoriqoh Ta\'lim wa Ta\'allum, senantiasa menjadikan santri yang berakhlaqul karimah, serta menjadi pengembangan keislaman dan dakwah multikultural.</p>
                <h3>Misi</h3>
                <ol>
                    <li>Mengembangkan pesantren secara keilmuan dan kelembagaan.</li>
                    <li>Melakukan pencerahan kepada masyarakat melalui kegiatan Ta\'allum, Tarbiyah, dan Ta\'dib.</li>
                    <li>Meningkatkan kompetensi lulusan Pondok Pesantren melalui pembekalan moral, skil, dan penguatan di bidang ilmiyah dan amaliyah.</li>
                </ol>',
                'post_type' => 'page',
                'post_category_id' => $profilCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'visi-misi',
                'featured_image' => null,
            ],
            [
                'title' => 'Struktur Organisasi Pondok Pesantren Roudlotut Tullab',
                'content' => '<h3>Pengasuh / Pimpinan Pondok</h3>
                <p>Agus Miftah Farid</p>
                <h3>Dewan Pembina / Penasehat</h3>
                <p>K. Abdul Rosyad Ghozali</p>
                <h3>Ketua Umum Pengurus Pondok</h3>
                <p>Agus Miftah Farid</p>
                <h3>Ketua Pondok</h3>
                <p>Ust. Doni Hamzah</p>
                <h3>Sekretaris</h3>
                <ul><li>Sekretaris I : Ust. Moh. Sa\'dulloh</li><li>Sekretaris II : Ust. Fikri Ali M</li></ul>
                <h3>Bendahara</h3>
                <ul><li>Bendahara I : Ustz. Tohirotul M</li><li>Bendahara II : Ustz. Nuril Aziziyah</li></ul>
                <h3>Bidang-Bidang Kepengurusan</h3>
                <h4>1. Bidang Pendidikan</h4>
                <ul><li>Kepala Madrasah Diniyah : Ust. Khoiri</li><li>Koordinator Pengajian Kitab : Ust. Humaidi</li><li>Koordinator Pendidikan Formal : Ust. Dimas Agung</li></ul>
                <h4>2. Bidang Keamanan dan Ketertiban</h4>
                <ul><li>Ketua Keamanan : Ust. Aldi Dianata</li><li>Anggota : Dandi Irawan, Eko Bayuki, Hamdan Tamimi</li></ul>
                <h4>3. Bidang Ubudiyah / Peribadatan</h4>
                <ul><li>Koordinator Imamah dan Jamaah : Ust. Ardi Setiawan</li><li>Koordinator Kegiatan Keagamaan : Ust. Moh Sa\'dulloh</li></ul>
                <h4>4. Bidang Kebersihan dan Kesehatan</h4>
                <ul><li>Koordinator Kebersihan : Ust. Ahmad Baihaqi</li><li>Koordinator Kesehatan Santri : Ust. Wildan Zanaldi</li></ul>
                <h4>5. Bidang Kesantrian</h4>
                <ul><li>Ketua Kesantrian : Ust. Abdul Basit</li><li>Pembina Santri : Ust. Herdi Setiawan</li></ul>
                <h4>6. Bidang Sarana dan Prasarana</h4>
                <ul><li>Koordinator Perlengkapan : Ust. Habib</li><li>Koordinator Pembangunan : Ust. Doni H</li></ul>
                <h4>7. Bidang Humas dan Dakwah</h4>
                <ul><li>Hubungan Masyarakat : Ust. Abdul Halim</li><li>Publikasi dan Dakwah : Ust. Hardiyanto</li></ul>
                <h4>8. Bidang Usaha / Kemandirian Pesantren</h4>
                <ul><li>Koperasi Santri : Ustz. Della</li><li>Unit Usaha Pondok : Ustz. Hafifah</li></ul>',
                'post_type' => 'page',
                'post_category_id' => $profilCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'struktur',
                'featured_image' => null,
            ],
            
            // ========== SAMBUTAN ==========
            [
                'title' => 'Sambutan Pimpinan Pondok Pesantren Roudlotut Tullab',
                'content' => '<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh</p>
                <p>Alhamdulillahi Rabbil \'Alamin, segala puji hanya milik Allah SWT yang telah melimpahkan rahmat, taufik, dan hidayah-Nya kepada kita semua. Shalawat serta salam semoga senantiasa tercurah kepada junjungan kita Nabi Muhammad SAW, beserta keluarga, sahabat, dan seluruh pengikutnya hingga akhir zaman.</p>
                <p>Dengan penuh rasa syukur, kami menyambut kehadiran Pondok Pesantren Roudlotut Tullab sebagai lembaga pendidikan Islam yang berkomitmen membina generasi berilmu, berakhlakul karimah, dan berpegang teguh pada ajaran Ahlussunnah wal Jama\'ah.</p>
                <p>Pondok Pesantren Roudlotut Tullab didirikan sebagai wadah menuntut ilmu, memperdalam kajian kitab-kitab salaf, membentuk karakter santri yang mandiri, disiplin, serta berjiwa ukhuwah Islamiyah. Kami berharap pesantren ini menjadi taman ilmu dan keberkahan, sebagaimana makna "Roudlotut Tullab" sebagai taman bagi para penuntut ilmu.</p>
                <p>Di pesantren ini, pendidikan tidak hanya berfokus pada penguasaan ilmu agama melalui madrasah diniyah dan pengajian kitab, namun juga mendukung pendidikan formal serta pembinaan keterampilan sebagai bekal santri dalam menghadapi kehidupan bermasyarakat.</p>
                <p>Kami menyadari bahwa membangun dan mengembangkan pesantren membutuhkan dukungan dari banyak pihak. Oleh karena itu, kami mengajak seluruh wali santri, masyarakat, dan para muhibbin untuk bersama-sama mendukung perjuangan pendidikan ini, demi terwujudnya generasi yang alim, shalih, dan bermanfaat bagi agama, bangsa, dan umat.</p>
                <p>Semoga Pondok Pesantren Roudlotut Tullab senantiasa diberi keberkahan oleh Allah SWT, menjadi pusat lahirnya kader-kader ulama dan penerus perjuangan Islam.</p>
                <p>Wassalamu\'alaikum Warahmatullahi Wabarakatuh</p>
                <p>23 April 2026<br><strong>Pengasuh Pondok Pesantren Roudlotut Tullab</strong><br>Agus Miftah Farid</p>',
                'post_type' => 'page',
                'post_category_id' => $sambutanCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'sambutan',
                'featured_image' => null,
            ],
            
            // ========== PROGRAM UNGGULAN ==========
            [
                'title' => 'Tahfidz Al-Qur\'an',
                'content' => 'Program hafalan 30 juz dengan target 3-5 tahun, dibimbing oleh asatidz bersanad. Santri dibimbing secara intensif dengan metode tahfidz yang telah terbukti efektif.',
                'post_type' => 'post',
                'post_category_id' => $programCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'tahfidz-al-quran',
                'featured_image' => null,
            ],
            [
                'title' => 'Kajian Kitab Kuning',
                'content' => 'Pembelajaran kitab klasik (Jurumiyah, Alfiyah, Fathul Qorib, dll) dengan metode sorogan dan bandongan. Santri dibekali kemampuan membaca kitab gundul.',
                'post_type' => 'post',
                'post_category_id' => $programCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'kajian-kitab-kuning',
                'featured_image' => null,
            ],
            [
                'title' => 'Bahasa Arab & Inggris',
                'content' => 'Program unggulan bahasa asing dengan metode immersion dan praktik sehari-hari. Santri dipersiapkan untuk menguasai bahasa asing sebagai bekal dakwah dan studi lanjut.',
                'post_type' => 'post',
                'post_category_id' => $programCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'bahasa-arab-inggris',
                'featured_image' => null,
            ],
            
            // ========== FASILITAS PREVIEW ==========
            [
                'title' => 'Masjid',
                'content' => 'Masjid utama pondok dengan kapasitas 1000 jamaah, dilengkapi dengan pendingin ruangan dan sound system yang baik.',
                'post_type' => 'post',
                'post_category_id' => $fasilitasCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'masjid',
                'featured_image' => null,
            ],
            [
                'title' => 'Asrama',
                'content' => 'Asrama santri putra dan putri dengan fasilitas lengkap, kamar mandi dalam, dan ruang belajar bersama.',
                'post_type' => 'post',
                'post_category_id' => $fasilitasCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'asrama',
                'featured_image' => null,
            ],
            [
                'title' => 'Perpustakaan',
                'content' => 'Koleksi 5000+ buku agama, umum, dan kitab kuning. Perpustakaan buka setiap hari.',
                'post_type' => 'post',
                'post_category_id' => $fasilitasCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'perpustakaan',
                'featured_image' => null,
            ],
            [
                'title' => 'Laboratorium',
                'content' => 'Lab komputer dan bahasa untuk menunjang pembelajaran santri dengan peralatan modern.',
                'post_type' => 'post',
                'post_category_id' => $fasilitasCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'laboratorium',
                'featured_image' => null,
            ],
            
            // ========== BERITA ==========
            [
                'title' => 'Santri Raih Juara 1 Olimpiade Sains',
                'content' => 'Santri Pondok Pesantren Roudlotut Tullab berhasil meraih juara 1 dalam Olimpiade Sains tingkat kabupaten. Prestasi ini membuktikan kualitas pendidikan di pondok kita.',
                'post_type' => 'post',
                'post_category_id' => $beritaCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'santri-raih-juara-1-olimpiade',
                'featured_image' => null,
            ],
            [
                'title' => 'Pesantren Kilat Ramadhan',
                'content' => 'Ribuan santri mengikuti kegiatan pesantren kilat dalam rangka menyambut bulan suci Ramadhan. Kegiatan diisi dengan kajian, tadarus, dan buka puasa bersama.',
                'post_type' => 'post',
                'post_category_id' => $beritaCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'pesantren-kilat-ramadhan',
                'featured_image' => null,
            ],
            [
                'title' => 'Kerjasama dengan Universitas Al-Azhar',
                'content' => 'Pondok menjalin kerjasama pendidikan dengan Universitas Al-Azhar Mesir untuk program beasiswa santri berprestasi.',
                'post_type' => 'post',
                'post_category_id' => $beritaCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'kerjasama-dengan-universitas-al-azhar',
                'featured_image' => null,
            ],
            
            // ========== TESTIMONI ==========
            [
                'title' => 'Bapak Santoso',
                'content' => 'Pondok yang sangat baik dalam mendidik santri. Anak saya menjadi lebih disiplin dan rajin beribadah.',
                'post_type' => 'post',
                'post_category_id' => $testimoniCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'testimoni-bapak-santoso',
                'featured_image' => null,
            ],
            [
                'title' => 'Ibu Fatimah',
                'content' => 'Fasilitas lengkap, asatidz profesional, dan lingkungan yang nyaman untuk belajar.',
                'post_type' => 'post',
                'post_category_id' => $testimoniCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'testimoni-ibu-fatimah',
                'featured_image' => null,
            ],
            [
                'title' => 'Alumni',
                'content' => 'Terima kasih Ponpes Roudlotut Tullab, saya berhasil melanjutkan studi ke Timur Tengah berbekal ilmu yang saya dapatkan di sini.',
                'post_type' => 'post',
                'post_category_id' => $testimoniCategory->id,
                'author_id' => 1,
                'published_at' => now(),
                'slug' => 'testimoni-alumni',
                'featured_image' => null,
            ],
        ];

        foreach ($posts as $post) {
            Post::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }
    }
}