@extends('layouts.app')

@section('title', 'Beranda - Pondok Pesantren Roudlotut Tullab')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-primary to-primaryDark text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <i class="fas fa-mosque text-9xl absolute top-10 left-10"></i>
        <i class="fas fa-quran text-8xl absolute bottom-10 right-10"></i>
    </div>
    <div class="container mx-auto px-4 py-20 md:py-28 relative z-10">
        <div class="text-center fade-in">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Pondok Pesantren <br> Roudlotut Tullab</h1>
            <p class="text-xl md:text-2xl text-white/90 max-w-2xl mx-auto">
                Mencetak Generasi yang Beriman, Berilmu, dan Berakhlak Mulia
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/profil/sejarah') }}" class="bg-white text-primary px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition shadow-lg inline-block">
                    Pelajari Lebih Lanjut
                </a>
                <a href="{{ url('/ppdb') }}" class="bg-primaryLight text-white px-8 py-3 rounded-full font-semibold hover:bg-green-600 transition shadow-lg inline-block">
                    Pendaftaran Santri Baru
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Statistik -->
<section class="py-12 bg-gray-50 dark:bg-gray-800 transition-colors">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="hover-scale">
                <div class="text-4xl font-bold text-primary">500+</div>
                <div class="text-gray-600 dark:text-gray-400 mt-1">Santri Aktif</div>
            </div>
            <div class="hover-scale">
                <div class="text-4xl font-bold text-primary">50+</div>
                <div class="text-gray-600 dark:text-gray-400 mt-1">Asatidz</div>
            </div>
            <div class="hover-scale">
                <div class="text-4xl font-bold text-primary">15+</div>
                <div class="text-gray-600 dark:text-gray-400 mt-1">Program Unggulan</div>
            </div>
            <div class="hover-scale">
                <div class="text-4xl font-bold text-primary">25+</div>
                <div class="text-gray-600 dark:text-gray-400 mt-1">Tahun Berdiri</div>
            </div>
        </div>
    </div>
</section>

<!-- Sambutan Singkat -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="order-2 md:order-1">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Sambutan Pimpinan</h2>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-4">
                    Assalamu'alaikum warahmatullahi wabarakatuh.
                </p>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-4">
                    Puji syukur kehadirat Allah SWT, atas segala rahmat dan karunia-Nya, Pondok Pesantren Roudlotut Tullab dapat terus berkembang dan memberikan kontribusi terbaik bagi pendidikan agama di Indonesia.
                </p>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-4">
                    Kami mengundang seluruh masyarakat untuk bergabung dan menjadi bagian dari keluarga besar Pondok Pesantren Roudlotut Tullab. Mari bersama-sama mencetak generasi yang beriman, berilmu, dan berakhlak mulia.
                </p>
                <a href="{{ url('/profil/sambutan') }}" class="text-primary font-semibold hover:underline">Baca selengkapnya →</a>
            </div>
            <div class="order-1 md:order-2 flex justify-center">
                <div class="w-64 h-64 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-circle text-8xl text-gray-400 dark:text-gray-500"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Program Unggulan -->
<section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-4">Program Unggulan</h2>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-12 max-w-2xl mx-auto">
            Berbagai program unggulan untuk membentuk santri yang berkualitas
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 text-center hover:shadow-xl transition hover-scale">
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-quran text-3xl text-primary"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Tahfidz Al-Qur'an</h3>
                <p class="text-gray-600 dark:text-gray-400">Program hafalan 30 juz dengan target 3-5 tahun, dibimbing oleh asatidz bersanad.</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 text-center hover:shadow-xl transition hover-scale">
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-book text-3xl text-primary"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Kajian Kitab Kuning</h3>
                <p class="text-gray-600 dark:text-gray-400">Pembelajaran kitab klasik (Jurumiyah, Alfiyah, Fathul Qorib, dll) dengan metode sorogan dan bandongan.</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 text-center hover:shadow-xl transition hover-scale">
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-language text-3xl text-primary"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Bahasa Arab & Inggris</h3>
                <p class="text-gray-600 dark:text-gray-400">Program unggulan bahasa asing dengan metode immersion dan praktik sehari-hari.</p>
            </div>
        </div>
    </div>
</section>

<!-- Fasilitas Preview -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-4">Fasilitas Pondok</h2>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-12 max-w-2xl mx-auto">
            Sarana dan prasarana yang mendukung kenyamanan belajar santri
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-5 text-center hover-scale">
                <i class="fas fa-mosque text-4xl text-primary mb-3"></i>
                <h3 class="font-semibold text-gray-800 dark:text-white">Masjid</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kapasitas 1000 jamaah</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-5 text-center hover-scale">
                <i class="fas fa-bed text-4xl text-primary mb-3"></i>
                <h3 class="font-semibold text-gray-800 dark:text-white">Asrama</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Putra & Putri</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-5 text-center hover-scale">
                <i class="fas fa-book text-4xl text-primary mb-3"></i>
                <h3 class="font-semibold text-gray-800 dark:text-white">Perpustakaan</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">5000+ koleksi</p>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-5 text-center hover-scale">
                <i class="fas fa-flask text-4xl text-primary mb-3"></i>
                <h3 class="font-semibold text-gray-800 dark:text-white">Laboratorium</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Komputer & Bahasa</p>
            </div>
        </div>
        <div class="text-center mt-8">
            <a href="{{ url('/fasilitas') }}" class="text-primary font-semibold hover:underline">Lihat semua fasilitas →</a>
        </div>
    </div>
</section>

<!-- Berita Terbaru -->
<section class="py-16 bg-gray-50 dark:bg-gray-800 transition-colors">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-4">Berita Terbaru</h2>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-12">Informasi terkini seputar kegiatan pondok</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md overflow-hidden hover-scale">
                <div class="h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-newspaper text-5xl text-gray-400"></i>
                </div>
                <div class="p-5">
                    <div class="text-sm text-primary mb-2">15 April 2026</div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Santri Raih Juara 1 Olimpiade</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Santri Pondok Pesantren Roudlotut Tullab berhasil meraih juara 1 dalam Olimpiade Sains...</p>
                    <a href="#" class="text-primary text-sm font-semibold hover:underline mt-3 inline-block">Baca selengkapnya →</a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md overflow-hidden hover-scale">
                <div class="h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-chalkboard-user text-5xl text-gray-400"></i>
                </div>
                <div class="p-5">
                    <div class="text-sm text-primary mb-2">10 April 2026</div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Pesantren Kilat Ramadhan</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Ribuan santri mengikuti kegiatan pesantren kilat dalam rangka menyambut bulan suci Ramadhan...</p>
                    <a href="#" class="text-primary text-sm font-semibold hover:underline mt-3 inline-block">Baca selengkapnya →</a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md overflow-hidden hover-scale">
                <div class="h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                    <i class="fas fa-handshake text-5xl text-gray-400"></i>
                </div>
                <div class="p-5">
                    <div class="text-sm text-primary mb-2">5 April 2026</div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Kerjasama dengan Universitas Al-Azhar</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Pondok menjalin kerjasama pendidikan dengan Universitas Al-Azhar Mesir untuk program beasiswa...</p>
                    <a href="#" class="text-primary text-sm font-semibold hover:underline mt-3 inline-block">Baca selengkapnya →</a>
                </div>
            </div>
        </div>
        <div class="text-center mt-8">
            <a href="{{ url('/berita') }}" class="bg-primary text-white px-6 py-2 rounded-lg font-semibold hover:bg-primaryDark transition">Lihat Semua Berita</a>
        </div>
    </div>
</section>

<!-- Testimoni -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-4">Testimoni</h2>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-12">Apa kata mereka tentang Pondok Pesantren Roudlotut Tullab</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 text-center">
                <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-2xl text-gray-500"></i>
                </div>
                <p class="text-gray-600 dark:text-gray-400 italic">"Pondok yang sangat baik dalam mendidik santri. Anak saya menjadi lebih disiplin dan rajin beribadah."</p>
                <h4 class="font-semibold text-gray-800 dark:text-white mt-4">- Bapak Santoso, Wali Santri</h4>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 text-center">
                <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user text-2xl text-gray-500"></i>
                </div>
                <p class="text-gray-600 dark:text-gray-400 italic">"Fasilitas lengkap, asatidz profesional, dan lingkungan yang nyaman untuk belajar."</p>
                <h4 class="font-semibold text-gray-800 dark:text-white mt-4">- Ibu Fatimah, Wali Santri</h4>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 text-center">
                <div class="w-16 h-16 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-graduate text-2xl text-gray-500"></i>
                </div>
                <p class="text-gray-600 dark:text-gray-400 italic">"Terima kasih Ponpes Roudlotut Tullab, saya berhasil melanjutkan studi ke Timur Tengah berbekal ilmu yang saya dapatkan di sini."</p>
                <h4 class="font-semibold text-gray-800 dark:text-white mt-4">- Alumni</h4>
            </div>
        </div>
    </div>
</section>

<!-- CTA PPDB -->
<section class="py-16 bg-gradient-to-r from-primary to-primaryDark text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Daftarkan Putra-Putri Anda Sekarang!</h2>
        <p class="text-white/90 mb-8 max-w-2xl mx-auto">
            Bergabunglah bersama kami untuk mencetak generasi yang beriman, berilmu, dan berakhlak mulia.
        </p>
        <a href="{{ url('/ppdb') }}" class="bg-white text-primary px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition shadow-lg inline-block">
            Pendaftaran Santri Baru
        </a>
    </div>
</section>
@endsection