<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConjugationTypeExample extends Model
{
    use HasFactory;
    protected $fillable = [
        'conjugation_type_id',
        'example_sentence',
    ];

    public function conjugationType()
    {
        return $this->belongsTo(ConjugationType::class);
    }
}
