<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $primaryKey = 'id_user';
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'username', 'password', 'role', 'verify_key', 'active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNameAttribute($value)
    {
        return $value ?: 'Unnamed User';
    }
}
