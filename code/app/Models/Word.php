<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Word extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'type', 'definition', 'example'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_word');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
