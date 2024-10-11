<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'word', 'creator'
    ];

    public function conjugations()
    {
        return $this->hasMany(self::class, 'base_verb_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_word');
    }

}
