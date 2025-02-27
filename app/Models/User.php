<?php

namespace App\Models;

use App\Models\Role; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password'
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function developpeur()
    {
        return $this->hasOne(Developer::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }
}
