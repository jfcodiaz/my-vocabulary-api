<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Word extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'word',
        'creator_id'
    ];

    /**
     * Get the user that created the word.
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    /*
     * Scope a query to include creator data.
     * This scope adds the creator relationship to the existing query, allowing easy retrieval
     * of the word along with its creator's data.
     *
     * @param Builder $query The query builder instance.
     *
     * @return Builder The query builder instance with the relationship loaded.
     */
    public function scopeWithCreator(Builder $query): Builder
    {
        return $query->with('creator');
    }
}
