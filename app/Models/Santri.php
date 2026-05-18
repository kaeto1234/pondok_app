<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $table = 'santri';

    protected $fillable = [
        'nis', 'user_id', 'pendaftaran_id',
        'nama_lengkap', 'tempat_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'alamat', 'telepon', 'foto', 'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function orangTua()
    {
        return $this->hasMany(OrangTua::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}