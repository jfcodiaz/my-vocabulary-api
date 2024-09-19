<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['word_id', 'review_date', 'proficiency_level'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
