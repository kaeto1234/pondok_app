<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'title', 'content', 'post_type', 'post_category_id', 'author_id',
        'published_at', 'slug', 'menu_order', 'featured_image'
    ];

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function galleries()
    {
        return $this->hasMany(PostGallery::class, 'post_id');
    }
}