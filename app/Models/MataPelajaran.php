<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = ['nama_mapel', 'deskripsi', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function kurikulum()
    {
        return $this->hasMany(Kurikulum::class);
    }

    public function kitab()
    {
        return $this->belongsToMany(Kitab::class, 'kitab_mapel')
                    ->withPivot('urutan')
                    ->withTimestamps();
    }
}