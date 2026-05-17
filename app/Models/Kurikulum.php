<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulum';
    
    protected $fillable = [
        'tahun_ajaran_id',
        'tingkat_diniyah_id',  // ← perhatikan ini
        'mata_pelajaran_id',   // ← perhatikan ini
        'urutan',
        'is_active',
    ];
    
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }
    
    public function tingkat()
    {
        return $this->belongsTo(TingkatDiniyah::class, 'tingkat_diniyah_id');
    }
    
    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id');
    }
    
    public function jadwalMengajar()
    {
        return $this->hasMany(JadwalMengajar::class, 'kurikulum_id');
    }
}