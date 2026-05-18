<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalMengajar extends Model
{
    protected $table = 'jadwal_mengajar';

    protected $fillable = [
        'tahun_ajaran_id', 'kurikulum_id', 'guru_id',
        'hari', 'jam_mulai', 'jam_selesai',
        'ruangan', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class)->with([
            'tingkatDiniyah', 'mataPelajaran'
        ]);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function absensiGuru()
    {
        return $this->hasMany(AbsensiGuru::class);
    }
}