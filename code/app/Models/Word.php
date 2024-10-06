<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'text', 'type_word_id', 'definition', 'example', 'base_verb_id', 'present', 'past', 'past_participle'
    ];


    public function baseVerb()
    {
        return $this->belongsTo(self::class, 'base_verb_id');
    }

    public function conjugations()
    {
        return $this->hasMany(self::class, 'base_verb_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_word');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
