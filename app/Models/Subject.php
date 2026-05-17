<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    
    protected $fillable = [
        'name',
        'book_name',
        'author',
        'description',
        'is_active'
    ];
}