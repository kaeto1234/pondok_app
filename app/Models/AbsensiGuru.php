<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiGuru extends Model
{
    protected $table = 'absensi_guru';
    
    protected $fillable = [
        'jadwal_mengajar_id',
        'tanggal',
        'pertemuan_ke',
        'status',
        'keterangan',
    ];
    
    protected $casts = [
        'tanggal' => 'date',
    ];
    
    public function jadwalMengajar()
    {
        return $this->belongsTo(JadwalMengajar::class, 'jadwal_mengajar_id');
    }
    
    public function absensiSantri()
    {
        return $this->hasMany(AbsensiSantri::class, 'absensi_guru_id');
    }
}