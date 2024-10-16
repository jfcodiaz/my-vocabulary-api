<?php

namespace App\Repositories;

use App\Models\WordType;
use App\Contracts\Repositories\IWordTypeRepository;

class WordTypeRepository extends BaseRepository implements IWordTypeRepository
{
    public function __construct(WordType $model)
    {
        parent::__construct($model);
    }

    public function getVerbType(): ?WordType
    {
        return $this->model->where('name', 'Verb')->first();
    }

    public function getNounType(): ?WordType
    {
        return $this->model->where('name', 'Noun')->first();
    }

    public function findRandomConjugation(): ?WordType
    {
        return $this->model->where('conjugation', true)->inRandomOrder()->first();
    }
}
