<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SantriTingkat extends Model
{
    protected $table = 'santri_tingkat';

    protected $fillable = [
        'santri_id', 'tahun_ajaran_id', 'tingkat_id',
        'tanggal_mulai', 'tanggal_selesai', 'status',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function tingkat()
    {
        return $this->belongsTo(TingkatDiniyah::class, 'tingkat_id');
    }

    public function absensiSantri()
    {
        return $this->hasMany(AbsensiSantri::class);
    }
}