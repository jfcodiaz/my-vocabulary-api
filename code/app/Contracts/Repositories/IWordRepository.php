<?php

namespace App\Contracts\Repositories;

use App\Models\Word;

/**
 * Interface for repository handling Word entities.
 */
interface IWordRepository extends IBaseRepository
{
    /**
     * Find a word by text along with its creator.
     *
     * This method retrieves a single Word model that matches the given word string
     * and includes the creator associated with the word.
     *
     * @param string $word The text of the word to search for.
     *
     * @throws \Illuminate\Database\QueryException If there is a database query error.
     *
     * @return Word|null The Word model if found; otherwise, null.
     */
    public function findWordWithCreator(string $word): ?Word;

    /**
     * Find a word by text.
     *
     * This method retrieves a single Word model that matches the given word string.
     *
     * @param string $word The text of the word to search for.
     *
     * @throws \Illuminate\Database\QueryException If there is a database query error.
     *
     * @return Word|null The Word model if found; otherwise, null.
     */
    public function findByWordValue(string $word): ?Word;
}
