<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';

    protected $fillable = [
        'santri_tingkat_id', 'kurikulum_id', 'jenis_ujian_id',
        'guru_id', 'nilai', 'tanggal_ujian', 'catatan',
    ];

    protected $casts = ['tanggal_ujian' => 'date'];

    public function santriTingkat()
    {
        return $this->belongsTo(SantriTingkat::class);
    }

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class);
    }

    public function jenisUjian()
    {
        return $this->belongsTo(JenisUjian::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}