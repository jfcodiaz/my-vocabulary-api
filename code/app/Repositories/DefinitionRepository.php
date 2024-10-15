<?php

namespace App\Repositories;

use App\Contracts\Repositories\IDefintionRepository;
use App\Contracts\Repositories\IWordTypeRepository;
use App\Models\Definition;
use App\Models\Word;
use App\Models\WordType;

class DefinitionRepository extends BaseRepository implements IDefintionRepository
{
    public function __construct(Definition $model)
    {
        parent::__construct($model);
    }

    public function findByTypeForWord(Word $word, WordType $type): ?Definition
    {
        return Definition::where('word_id', $word->id)
        ->where('word_type_id', $type->id)->get()->first();
    }
}
