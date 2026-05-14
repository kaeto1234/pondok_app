<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileBerkasPendaftaran extends Model
{
    protected $table = 'file_berkas_pendaftaran';
    protected $fillable = ['pendaftaran_id', 'berkas_periode_pendaftaran_id', 'path_file'];
    
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }
    
    public function berkasPeriode()
    {
        return $this->belongsTo(BerkasPeriodePendaftaran::class, 'berkas_periode_pendaftaran_id');
    }
}
