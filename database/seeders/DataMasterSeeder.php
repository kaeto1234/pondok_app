<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\JadwalMengajar;
use App\Models\JenisUjian;
use App\Models\Kitab;
use App\Models\Kurikulum;
use App\Models\MataPelajaran;
use App\Models\Santri;
use App\Models\SantriTingkat;
use App\Models\TahunAjaran;
use App\Models\TingkatDiniyah;
use Illuminate\Database\Seeder;

class DataMasterSeeder extends Seeder
{
    public function run()
    {
        // ─── 0. TAHUN AJARAN ────────────
        $tahunAjaran = TahunAjaran::firstOrCreate(
            ['nama_tahun' => '2025/2026'],
            [
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2026-06-30',
                'is_active' => true,
            ]
        );

        // ─── 1. TINGKAT DINIYAH ───────────────────────────────
        $tingkatan = [
            ['nama_tingkat' => 'Ula 1',    'urutan' => 1, 'is_active' => true],
            ['nama_tingkat' => 'Ula 2',    'urutan' => 2, 'is_active' => true],
            ['nama_tingkat' => 'Ula 3',    'urutan' => 3, 'is_active' => true],
            ['nama_tingkat' => 'Wustho 1', 'urutan' => 4, 'is_active' => true],
            ['nama_tingkat' => 'Wustho 2', 'urutan' => 5, 'is_active' => true],
        ];

        foreach ($tingkatan as $t) {
            TingkatDiniyah::firstOrCreate(['nama_tingkat' => $t['nama_tingkat']], $t);
        }

        // ─── 2. MATA PELAJARAN ────────────────────────────────
        $mapel = [
            ['nama_mapel' => 'Fiqih',           'deskripsi' => 'Ilmu hukum-hukum syariat Islam'],
            ['nama_mapel' => 'Nahwu',            'deskripsi' => 'Ilmu tata bahasa Arab'],
            ['nama_mapel' => 'Shorof',           'deskripsi' => 'Ilmu perubahan bentuk kata Arab'],
            ['nama_mapel' => 'Tafsir',           'deskripsi' => 'Ilmu penafsiran Al-Quran'],
            ['nama_mapel' => 'Hadits',           'deskripsi' => 'Ilmu hadits Nabi SAW'],
            ['nama_mapel' => 'Aqidah',           'deskripsi' => 'Ilmu pokok-pokok keimanan'],
            ['nama_mapel' => 'Akhlaq',           'deskripsi' => 'Ilmu budi pekerti dan etika Islam'],
            ['nama_mapel' => 'Tarikh Islam',     'deskripsi' => 'Sejarah peradaban Islam'],
            ['nama_mapel' => 'Tajwid',           'deskripsi' => 'Ilmu membaca Al-Quran dengan benar'],
            ['nama_mapel' => 'Bahasa Arab',      'deskripsi' => 'Pelajaran bahasa Arab'],
            ['nama_mapel' => 'Imla',             'deskripsi' => 'Latihan menulis Arab'],
            ['nama_mapel' => 'Muthalaah',        'deskripsi' => 'Ilmu membaca teks Arab'],
        ];

        foreach ($mapel as $m) {
            MataPelajaran::firstOrCreate(['nama_mapel' => $m['nama_mapel']], array_merge($m, ['is_active' => true]));
        }

        // ─── 3. KITAB ─────────────────────────────────────────
        $kitab = [
            ['nama_kitab' => 'Mabadi Fiqih Juz 1',    'pengarang' => 'Umar Abdul Jabbar'],
            ['nama_kitab' => 'Mabadi Fiqih Juz 2',    'pengarang' => 'Umar Abdul Jabbar'],
            ['nama_kitab' => 'Mabadi Fiqih Juz 3',    'pengarang' => 'Umar Abdul Jabbar'],
            ['nama_kitab' => 'Fathul Qorib',           'pengarang' => 'Ibnu Qosim Al-Ghazi'],
            ['nama_kitab' => 'Jurumiyah',              'pengarang' => 'Imam Ash-Shanhaji'],
            ['nama_kitab' => 'Imrithi',                'pengarang' => 'Syarafuddin Al-Imrithi'],
            ['nama_kitab' => 'Alfiyah Ibnu Malik',    'pengarang' => 'Ibnu Malik'],
            ['nama_kitab' => 'Amtsilah Tasrifiyah',   'pengarang' => 'Muhammad Ma\'shum'],
            ['nama_kitab' => 'Aqidatul Awam',          'pengarang' => 'Sayyid Ahmad Al-Marzuqi'],
            ['nama_kitab' => 'Jawahirul Kalamiyah',   'pengarang' => 'Thahir Al-Jazairi'],
            ['nama_kitab' => 'Arba\'in Nawawi',        'pengarang' => 'Imam Nawawi'],
            ['nama_kitab' => 'Bulughul Maram',         'pengarang' => 'Ibnu Hajar Al-Asqalani'],
            ['nama_kitab' => 'Tafsir Jalalain',        'pengarang' => 'Jalaluddin Al-Mahalli'],
            ['nama_kitab' => 'Ta\'lim Muta\'allim',   'pengarang' => 'Az-Zarnuji'],
            ['nama_kitab' => 'Washoya',                'pengarang' => 'Muhammad Syakir'],
        ];

        foreach ($kitab as $k) {
            Kitab::firstOrCreate(['nama_kitab' => $k['nama_kitab']], $k);
        }

        // ─── 4. JENIS UJIAN ───────────────────────────────────
        $jenisUjian = [
            ['nama' => 'Ujian Harian',    'bobot' => 20, 'keterangan' => 'Ulangan harian'],
            ['nama' => 'Ujian Tengah',    'bobot' => 30, 'keterangan' => 'Ujian Tengah Semester'],
            ['nama' => 'Ujian Akhir',     'bobot' => 50, 'keterangan' => 'Ujian Akhir Semester'],
        ];

        foreach ($jenisUjian as $j) {
            JenisUjian::firstOrCreate(['nama' => $j['nama']], $j);
        }

        // ─── 5. KURIKULUM ─────────────────────────────────────
        // Mapel per tingkat (sesuai kurikulum pondok umum)
        $kurikulumMap = [
            'Ula 1' => ['Tajwid', 'Fiqih', 'Aqidah', 'Akhlaq', 'Imla'],
            'Ula 2' => ['Tajwid', 'Fiqih', 'Nahwu', 'Shorof', 'Aqidah', 'Akhlaq'],
            'Ula 3' => ['Fiqih', 'Nahwu', 'Shorof', 'Hadits', 'Aqidah', 'Tarikh Islam'],
            'Wustho 1' => ['Fiqih', 'Nahwu', 'Shorof', 'Hadits', 'Tafsir', 'Bahasa Arab', 'Muthalaah'],
            'Wustho 2' => ['Fiqih', 'Nahwu', 'Hadits', 'Tafsir', 'Bahasa Arab', 'Muthalaah', 'Tarikh Islam'],
        ];

        $tahunAjaran = TahunAjaran::where('is_active', true)->first();

        if ($tahunAjaran) {
            foreach ($kurikulumMap as $namaTingkat => $mapelList) {
                $tingkat = TingkatDiniyah::where('nama_tingkat', $namaTingkat)->first();

                foreach ($mapelList as $urutan => $namaMapel) {
                    $mp = MataPelajaran::where('nama_mapel', $namaMapel)->first();

                    if ($tingkat && $mp) {
                        Kurikulum::firstOrCreate(
                            [
                                'tahun_ajaran_id' => $tahunAjaran->id,
                                'tingkat_diniyah_id' => $tingkat->id,
                                'mata_pelajaran_id' => $mp->id,
                            ],
                            [
                                'urutan' => $urutan + 1,
                                'is_active' => true,
                            ]
                        );
                    }
                }
            }
        }

        // ─── 6. JADWAL MENGAJAR ───────────────────────────────
        $guru = Guru::first();

        if ($guru && $tahunAjaran) {
            $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Sabtu'];
            $jam = [
                ['jam_mulai' => '07:00', 'jam_selesai' => '08:30'],
                ['jam_mulai' => '08:30', 'jam_selesai' => '10:00'],
                ['jam_mulai' => '13:00', 'jam_selesai' => '14:30'],
            ];

            $kurikulumList = Kurikulum::where('tahun_ajaran_id', $tahunAjaran->id)
                ->limit(5)
                ->get();

            foreach ($kurikulumList as $index => $kur) {
                JadwalMengajar::firstOrCreate(
                    [
                        'tahun_ajaran_id' => $tahunAjaran->id,
                        'kurikulum_id' => $kur->id,
                        'guru_id' => $guru->id,
                    ],
                    [
                        'hari' => $hariList[$index % count($hariList)],
                        'jam_mulai' => $jam[$index % count($jam)]['jam_mulai'],
                        'jam_selesai' => $jam[$index % count($jam)]['jam_selesai'],
                        'ruangan' => 'Kelas '.chr(65 + $index),
                        'is_active' => true,
                    ]
                );
            }
        }

        // ─── 7. SANTRI TINGKAT ────────────────────────────────
        // Assign santri yang ada ke tingkat
        if ($tahunAjaran) {
            $santriList = Santri::where('status', 'aktif')->get();
            $tingkatList = TingkatDiniyah::where('is_active', true)->get();

            foreach ($santriList as $index => $santri) {
                $tingkat = $tingkatList[$index % $tingkatList->count()];

                SantriTingkat::firstOrCreate(
                    [
                        'santri_id' => $santri->id,
                        'tahun_ajaran_id' => $tahunAjaran->id,
                    ],
                    [
                        'tingkat_id' => $tingkat->id,
                        'tanggal_mulai' => $tahunAjaran->tanggal_mulai ?? now(),
                        'status' => 'aktif',
                    ]
                );
            }
        }

        $this->command->info('✅ Data master berhasil di-seed!');
        $this->command->info('   - Tingkat  : '.TingkatDiniyah::count());
        $this->command->info('   - Mapel    : '.MataPelajaran::count());
        $this->command->info('   - Kitab    : '.Kitab::count());
        $this->command->info('   - Kurikulum: '.Kurikulum::count());
        $this->command->info('   - Jadwal   : '.JadwalMengajar::count());
        $this->command->info('   - Santri Tingkat: '.SantriTingkat::count());
    }
}
