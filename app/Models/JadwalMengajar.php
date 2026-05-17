<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalMengajar extends Model
{
    protected $table = 'jadwal_mengajar';
    
    protected $fillable = [
        'tahun_ajaran_id',
        'kurikulum_id',
        'guru_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        'is_active',
    ];
    
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }
    
    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id');
    }
    
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}