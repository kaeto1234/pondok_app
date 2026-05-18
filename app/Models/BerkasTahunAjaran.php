<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasTahunAjaran extends Model
{
    protected $table = 'berkas_tahun_ajaran';

    protected $fillable = ['tahun_ajaran_id', 'jenis_berkas_id', 'is_wajib', 'urutan'];

    protected $casts = ['is_wajib' => 'boolean'];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function jenisBerkas()
    {
        return $this->belongsTo(JenisBerkas::class);
    }

    public function fileBerkas()
    {
        return $this->hasMany(FileBerkasPendaftaran::class, 'berkas_tahun_ajaran_id');
    }
}