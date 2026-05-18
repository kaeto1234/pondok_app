<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulum';

    protected $fillable = [
        'tahun_ajaran_id', 'tingkat_diniyah_id',
        'mata_pelajaran_id', 'urutan', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function tingkatDiniyah()
    {
        return $this->belongsTo(TingkatDiniyah::class);
    }

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function jadwalMengajar()
    {
        return $this->hasMany(JadwalMengajar::class);
    }
}