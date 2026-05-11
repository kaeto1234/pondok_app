<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuPost extends Model
{
    protected $table = 'menu_posts';
    protected $fillable = ['menu_id', 'post_id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}