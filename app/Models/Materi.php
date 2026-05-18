<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';

    protected $fillable = [
        'judul', 'deskripsi', 'path_file', 'ukuran_file',
        'mapel_id', 'tingkat_id', 'diupload_oleh', 'diunduh',
    ];

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }

    public function tingkat()
    {
        return $this->belongsTo(TingkatDiniyah::class, 'tingkat_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'diupload_oleh');
    }
}