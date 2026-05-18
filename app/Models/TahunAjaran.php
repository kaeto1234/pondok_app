<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';

    protected $fillable = ['nama_tahun', 'tanggal_mulai', 'tanggal_selesai', 'is_active'];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'is_active'       => 'boolean',
    ];

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function berkasTahunAjaran()
    {
        return $this->hasMany(BerkasTahunAjaran::class);
    }
}