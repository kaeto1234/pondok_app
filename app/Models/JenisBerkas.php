<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisBerkas extends Model
{
    protected $table = 'jenis_berkas';
    protected $fillable = ['nama', 'tipe_file', 'ukuran_maksimal'];
}
