<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';
    
    protected $fillable = [
        'nama_mapel',
        'deskripsi',
        'is_active',
    ];
    
    public function kurikulum()
    {
        return $this->hasMany(Kurikulum::class, 'mapel_id');
    }
    
    public function kitab()
    {
        return $this->belongsToMany(Kitab::class, 'kitab_mapel', 'mapel_id', 'kitab_id');
    }
}