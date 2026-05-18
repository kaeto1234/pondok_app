<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = 'orang_tua';

    protected $fillable = [
        'santri_id', 'user_id',
        'nama_ayah', 'pendidikan_ayah', 'pekerjaan_ayah', 'telepon_ayah',
        'nama_ibu', 'pendidikan_ibu', 'pekerjaan_ibu', 'telepon_ibu',
        'nama_wali', 'hubungan_wali', 'telepon_wali',
        'alamat',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}