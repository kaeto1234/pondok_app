<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuLink extends Model
{
    protected $table = 'menu_links';
    
    protected $fillable = [
        'menu_id',
        'url',
    ];
    
    // Relasi ke menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}