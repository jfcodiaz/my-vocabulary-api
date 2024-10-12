<?php

namespace App\Contracts\Repositories;

use App\Models\Word;

/**
 * Interface for repository handling Word entities.
 */
interface IWordRepository
{
    /**
     * Find a word by text along with its creator.
     *
     * This method retrieves a single Word model that matches the given word string
     * and includes the creator associated with the word.
     *
     * @param string $word The text of the word to search for.
     * @return Word|null The Word model if found; otherwise, null.
     */
    public function findWordWithCreator(string $word): Word|null;
}
