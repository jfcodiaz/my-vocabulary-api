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

    public function type()
    {
        return $this->belongsTo(TypeWord::class, 'type_word_id');
    }

    public function baseVerb()
    {
        return $this->belongsTo(Word::class, 'base_verb_id');
    }

    public function conjugations()
    {
        return $this->hasMany(Word::class, 'base_verb_id');
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
