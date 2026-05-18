<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'user_id', 'nip', 'nama_lengkap',
        'telepon', 'email', 'keahlian',
        'tanggal_masuk', 'is_active',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'is_active'     => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}