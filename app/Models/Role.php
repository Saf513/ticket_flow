<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    // Ajoutez cette méthode pour le débogage
    public static function boot()
    {
        parent::boot();
        static::retrieved(function ($role) {
            Log::info('Rôle récupéré', ['role' => $role->toArray()]);
        });
    }
}
