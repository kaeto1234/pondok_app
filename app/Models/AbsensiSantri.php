<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiSantri extends Model
{
    protected $table = 'absensi_santri';
    
    protected $fillable = [
        'absensi_guru_id',
        'santri_tingkat_id',
        'status',
        'keterangan',
    ];
    
    public function absensiGuru()
    {
        return $this->belongsTo(AbsensiGuru::class, 'absensi_guru_id');
    }
    
    public function santriTingkat()
    {
        return $this->belongsTo(SantriTingkat::class, 'santri_tingkat_id');
    }
}