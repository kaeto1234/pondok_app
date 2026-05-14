<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $fillable = [
        'no_pendaftaran', 'periode_pendaftaran_id', 'nama_lengkap', 'tempat_lahir',
        'tanggal_lahir', 'jenis_kelamin', 'asal_sekolah', 'alamat', 'nama_orang_tua',
        'telepon_orang_tua', 'tanggal_daftar', 'status', 'catatan',
        'diverifikasi_oleh', 'diverifikasi_pada'
    ];
    
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_daftar' => 'datetime',
        'diverifikasi_pada' => 'datetime',
    ];
    
    public function periodePendaftaran()
    {
        return $this->belongsTo(PeriodePendaftaran::class, 'periode_pendaftaran_id');
    }
    
    public function diverifikasiOleh()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }
    
    public function fileBerkas()
    {
        return $this->hasMany(FileBerkasPendaftaran::class, 'pendaftaran_id');
    }
    
    public function santri()
    {
        return $this->hasOne(Santri::class, 'pendaftaran_id');
    }
}
