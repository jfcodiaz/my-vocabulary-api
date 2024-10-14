<?php
namespace App\Repositories;

use App\Models\UserWord;
use App\Contracts\Repositories\IUserWordRepository;
use Illuminate\Database\Eloquent\{ Builder, Collection };
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserWordRepository extends BaseRepository implements IUserWordRepository
{
    public function __construct(UserWord $model)
    {
        parent::__construct($model);
    }
    /**
     * Get all words for a user by their ID (without pagination).
     *
     * @param int $userId
     *
     * @return Collection
     */
    public function getUserWordsForUserId(int $userId): Collection
    {
        // This query retrieves all UserWord records for the provided user ID
        // and includes the associated 'word' relationship for each result
        return UserWord::where('user_id', $userId)
            ->with('word')
            ->get(); // Executes the query and returns the collection
    }

    /**
     * Get the UserWord query for a user by their ID (without executing it).
     *
     * @param int $userId
     *
     * @return Builder
     */
    public function getUserWordsForUserIdQuery(int $userId): Builder
    {
        // This method returns the query without executing it,
        // giving flexibility to add additional filters or operations later
        return UserWord::where('user_id', $userId)
            ->with('word'); // The 'word' relationship is eagerly loaded
    }

    /**
     * Get the user's words with pagination by user ID.
     *
     * @param int $userId
     * @param int $perPage
     * @param int|null $page
     *
     * @return LengthAwarePaginator
     */
    public function getUserWordsForUserIdWithPagination(int $userId, int $perPage = 10, ?int $page = null): LengthAwarePaginator
    {
        // This uses the reusable query method from above to build the base query
        $query = $this->getUserWordsForUserIdQuery($userId);

        // This applies pagination. The 'page' parameter is optional:
        // if null, Laravel will automatically handle the current page based on the request.
        // Pagination returns a LengthAwarePaginator, which includes pagination meta information
        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}
