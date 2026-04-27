<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostGallery extends Model
{
    protected $table = 'post_galleries';
    protected $fillable = ['post_id', 'image_path', 'caption', 'is_primary'];
}