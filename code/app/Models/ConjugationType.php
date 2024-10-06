<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConjugationType extends Model
{
    use HasFactory;

    protected $table = 'conjugation_types';

    protected $fillable = [
        'name',
        'description',
    ];

    public function examples()
    {
        return $this->hasMany(ConjugationTypeExample::class);
    }
}
