<?php
namespace App\Contracts\Repositories;

use App\Models\Word;
use App\Models\WordType;
use App\Models\Definition;

interface IDefintionRepository extends IBaseRepository
{
    public function findByTypeForWord(Word $word, WordType $type): ?Definition;
}
