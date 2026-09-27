<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\JenisBerkas;
use App\Models\Kitab;
use App\Models\MataPelajaran;
use App\Models\Menu;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Santri;
use App\Models\TahunAjaran;
use App\Models\TingkatDiniyah;

class DashboardController extends Controller
{
    public function index()
    {
        // === STATISTIK ===
        $totalPosts = Post::count();
        $totalCategories = PostCategory::count();
        $totalMenus = Menu::count();

        $totalProfil = Post::whereHas('category', fn ($q) => $q->where('slug', 'profil'))->count();
        $totalKontak = Post::whereHas('category', fn ($q) => $q->where('slug', 'kontak'))->count();
        $totalAkademik = Post::whereHas('category', fn ($q) => $q->where('slug', 'akademik'))->count();
        $totalFasilitas = Post::whereHas('category', fn ($q) => $q->where('slug', 'fasilitas'))->count();

        // === HISTORI AKTIVITAS (tanpa tabel baru) ===
        $activityLogs = $this->getRecentActivities();

        return view('admin.dashboard', compact(
            'totalPosts',
            'totalCategories',
            'totalMenus',
            'totalProfil',
            'totalKontak',
            'totalAkademik',
            'totalFasilitas',
            'activityLogs'
        ));
    }

    /**
     * Ambil aktivitas terbaru dari berbagai tabel
     */
    private function getRecentActivities($limit = 10)
    {
        $activities = collect();

        // === DATA MASTER ===
        $this->addActivity($activities, TahunAjaran::class, 'Tahun Ajaran', 'nama_tahun');
        $this->addActivity($activities, Guru::class, 'Guru', 'nama_lengkap');
        $this->addActivity($activities, Santri::class, 'Santri', 'nama_lengkap');
        $this->addActivity($activities, Kitab::class, 'Kitab', 'nama_kitab');
        $this->addActivity($activities, TingkatDiniyah::class, 'Tingkat Diniyah', 'nama_tingkat');
        $this->addActivity($activities, MataPelajaran::class, 'Mata Pelajaran', 'nama_mapel');
        $this->addActivity($activities, JenisBerkas::class, 'Jenis Berkas', 'nama');

        // === KONTEN WEBSITE ===
        $this->addActivity($activities, Post::class, 'Post', 'title');
        $this->addActivity($activities, PostCategory::class, 'Kategori', 'name');
        $this->addActivity($activities, Menu::class, 'Menu', 'label');

        // Urutkan berdasarkan waktu terbaru, ambil N teratas
        return $activities
            ->sortByDesc('waktu')
            ->take($limit)
            ->values();
    }

    /**
     * Helper untuk ambil data terbaru dari satu model
     * - Data yang baru DIBUAT (created)
     * - Data yang baru DIEDIT (updated, minimal 60 detik setelah created)
     */
    private function addActivity(&$activities, $modelClass, $label, $nameField)
    {
        try {
            // === AMBIL 5 DATA YANG PALING BARU DIBUAT ===
            $recentlyCreated = $modelClass::orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            foreach ($recentlyCreated as $item) {
                $activities->push([
                    'model' => $label,
                    'action' => 'created',
                    'name' => $item->$nameField ?? '-',
                    'waktu' => $item->created_at,
                ]);
            }

            // === AMBIL 5 DATA YANG PALING BARU DIEDIT ===
            // Hanya yang updated_at > created_at + 60 detik (biar tidak dobel dengan created)
            $recentlyUpdated = $modelClass::whereColumn('updated_at', '>', 'created_at')
                ->whereRaw('TIMESTAMPDIFF(SECOND, created_at, updated_at) > 60')
                ->orderBy('updated_at', 'desc')
                ->take(5)
                ->get();

            foreach ($recentlyUpdated as $item) {
                $activities->push([
                    'model' => $label,
                    'action' => 'updated',
                    'name' => $item->$nameField ?? '-',
                    'waktu' => $item->updated_at,
                ]);
            }
        } catch (\Exception $e) {
            // Kalau tabel tidak ada atau error, skip
        }
    }
}
