<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'no_pendaftaran', 'tahun_ajaran_id',
        'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'asal_sekolah', 'alamat',
        'nama_orang_tua', 'telepon_orang_tua', 'email',
        'nama_ayah', 'pekerjaan_ayah',
        'nama_ibu', 'pekerjaan_ibu',
        'tanggal_daftar', 'status', 'catatan',
        'diverifikasi_oleh', 'diverifikasi_pada',
    ];

    protected $casts = [
        'tanggal_lahir'    => 'date',
        'tanggal_daftar'   => 'datetime',
        'diverifikasi_pada'=> 'datetime',
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function fileBerkas()
    {
        return $this->hasMany(FileBerkasPendaftaran::class);
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }

    public function santri()
    {
        return $this->hasOne(Santri::class);
    }
}