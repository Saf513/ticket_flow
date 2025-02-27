<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'speciality'];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
