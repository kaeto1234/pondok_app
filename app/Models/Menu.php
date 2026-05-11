<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = ['label', 'parent_id', 'order', 'is_active'];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    public function post()
    {
        return $this->hasOne(MenuPost::class, 'menu_id');
    }

    public function link()
    {
        return $this->hasOne(MenuLink::class, 'menu_id');
    }
}