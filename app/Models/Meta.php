<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table = 'meta';

    protected $fillable = [
        'meta_key', 'meta_value', 'meta_group', 'order', 'is_active',
    ];
}
