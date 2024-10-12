<?php

namespace App\Repositories;

use App\Models\Word;
use App\Contracts\Repositories\IWordRepository;

class WordRepository extends BaseRepository implements IWordRepository
{
    protected $model;

    /**
     * Create a new WordRepository instance.
     *
     * @param Word $model The Word model instance.
     */
    public function __construct(Word $model)
    {
        $this->model = $model;
    }

    /**
     * Find a word by text along with its creator.
     *
     * @param string $word The word to search for.
     * @return Word|null The word if found, otherwise null.
     */
    public function findWordWithCreator(string $word): Word|null
    {
        return $this->model->withCreator()->where('word', $word)->first();
    }
}
