<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'username', 'email', 'password',
        'full_name', 'is_active', 'role_id',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function orangTua()
    {
        return $this->hasOne(OrangTua::class);
    }

    public function santri()
    {
        return $this->hasOne(Santri::class);
    }

    public function guru()
    {
        return $this->hasOne(Guru::class);
    }

    public function isAdmin()
    {
        return $this->role_id === 1;
    }

    public function isGuru()
    {
        return $this->role_id === 2;
    }

    public function isWali()
    {
        return $this->role_id === 3;
    }
}
