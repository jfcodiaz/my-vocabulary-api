<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
    protected $fillable = ['word_id', 'definition', 'word_type_id', 'creator_id'];
}
