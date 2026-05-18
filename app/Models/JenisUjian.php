<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisUjian extends Model
{
    protected $table = 'jenis_ujian';

    protected $fillable = ['nama', 'bobot', 'keterangan'];

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}