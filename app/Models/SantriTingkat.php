<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SantriTingkat extends Model
{
    protected $table = 'santri_tingkat';
    
    protected $fillable = [
        'santri_id',
        'tahun_ajaran_id',
        'tingkat_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];
    
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];
    
    /**
     * Relasi ke santri
     */
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }
    
    /**
     * Relasi ke tahun ajaran
     */
    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }
    
    /**
     * Relasi ke tingkat diniyah (kelas)
     */
    public function tingkat()
    {
        return $this->belongsTo(TingkatDiniyah::class, 'tingkat_id');
    }
    
    /**
     * Relasi ke absensi santri
     */
    public function absensiSantri()
    {
        return $this->hasMany(AbsensiSantri::class, 'santri_tingkat_id');
    }
    
    /**
     * Relasi ke nilai
     */
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'santri_tingkat_id');
    }
    
    /**
     * Scope untuk status aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}