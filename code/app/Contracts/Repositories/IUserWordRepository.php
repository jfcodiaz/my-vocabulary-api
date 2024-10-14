<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IUserWordRepository extends IBaseRepository
{
        /**
     * Get all words for a user by their ID (without pagination).
     *
     * @param int $userId
     *
     * @return Collection
     */
    public function getUserWordsForUserId(int $userId): Collection;

    /**
     * Get the UserWord query for a user by their ID (without executing it).
     *
     * @param int $userId
     *
     * @return Builder
     */
    public function getUserWordsForUserIdQuery(int $userId): Builder;

    /**
     * Get the user's words with pagination by user ID.
     *
     * @param int $userId
     * @param int $perPage
     * @param int|null $page
     *
     * @return LengthAwarePaginator
     */
    public function getUserWordsForUserIdWithPagination(int $userId, int $perPage = 10, ?int $page = null): LengthAwarePaginator;

}
