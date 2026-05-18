<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kitab extends Model
{
    protected $table = 'kitab';

    protected $fillable = [
        'nama_kitab', 'pengarang', 'penerbit',
        'tahun_terbit', 'deskripsi',
    ];

    public function mataPelajaran()
    {
        return $this->belongsToMany(MataPelajaran::class, 'kitab_mapel')
                    ->withPivot('urutan')
                    ->withTimestamps();
    }
}