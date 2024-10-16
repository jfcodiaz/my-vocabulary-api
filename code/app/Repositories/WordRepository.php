<?php

namespace App\Repositories;

use App\Models\Word;
use App\Contracts\Repositories\IWordRepository;

class WordRepository extends BaseRepository implements IWordRepository
{

    /**
     * Create a new WordRepository instance.
     *
     * @param Word $model The Word model instance.
     */
    public function __construct(Word $model)
    {
        parent::__construct($model);
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


    /**
     * Find a word by text.
     *
     * @param string $word The word to search for.
     *
     * @return Word|null The word if found, otherwise null.
     */
    public function findByWordValue(string $word): Word|null
    {
        return $this->model->where('word', $word)->first();
    }
}
