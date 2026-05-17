<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TingkatDiniyah extends Model
{
    protected $table = 'tingkat_diniyah';
    
    protected $fillable = ['nama_tingkat', 'urutan', 'is_active'];
    
    public function kurikulum()
    {
        return $this->hasMany(Kurikulum::class, 'tingkat_diniyah_id');
    }
    
    public function santriTingkat()
    {
        return $this->hasMany(SantriTingkat::class, 'tingkat_id');
    }
}