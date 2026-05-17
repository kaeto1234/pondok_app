<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodePendaftaran extends Model
{
    protected $table = 'periode_pendaftaran';
    protected $fillable = ['tahun_ajaran', 'nama', 'tanggal_mulai', 'tanggal_selesai', 'is_active'];
    
    public function berkasPeriode()
    {
        return $this->hasMany(BerkasPeriodePendaftaran::class, 'periode_pendaftaran_id');
    }
    
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'periode_pendaftaran_id');
    }
}
