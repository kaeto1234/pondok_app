<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileBerkasPendaftaran extends Model
{
    protected $table = 'file_berkas_pendaftaran';

    protected $fillable = ['pendaftaran_id', 'berkas_tahun_ajaran_id', 'path_file'];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function berkasTahunAjaran()
    {
        return $this->belongsTo(BerkasTahunAjaran::class);
    }
}