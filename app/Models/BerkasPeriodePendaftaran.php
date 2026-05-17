<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasPeriodePendaftaran extends Model
{
    protected $table = 'berkas_periode_pendaftaran';
    protected $fillable = ['periode_pendaftaran_id', 'jenis_berkas_id', 'is_required', 'urutan'];
    
    public function periodePendaftaran()
    {
        return $this->belongsTo(PeriodePendaftaran::class, 'periode_pendaftaran_id');
    }
    
    public function jenisBerkas()
    {
        return $this->belongsTo(JenisBerkas::class, 'jenis_berkas_id');
    }
}
