<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserWord extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'word_id',
        'proficiency_level',
        'created_at',
        'updated_at',
    ];

    public function word()
    {
        return $this->belongsTo(Word::class, 'word_id', 'id');
    }
}
