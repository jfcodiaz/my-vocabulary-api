<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property string|null $source
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Text extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'content', 'source'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
