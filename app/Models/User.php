<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Konstanta roles
    const ROLE_ADMIN = 'admin';
    const ROLE_OPERATOR = 'operator';
    const ROLE_USER = 'user';

    // Daftar semua roles
    public static function getRoles()
    {
        return [
            self::ROLE_ADMIN => 'Administrator',
            self::ROLE_OPERATOR => 'Operator',
            self::ROLE_USER => 'User',
        ];
    }

    // Accessor untuk role name
    public function getRoleNameAttribute()
    {
        return self::getRoles()[$this->role] ?? ucfirst($this->role);
    }

    // Method untuk cek role
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function isAdmin()
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    public function isOperator()
    {
        return $this->hasRole(self::ROLE_OPERATOR);
    }

    public function isUser()
    {
        return $this->hasRole(self::ROLE_USER);
    }
}
