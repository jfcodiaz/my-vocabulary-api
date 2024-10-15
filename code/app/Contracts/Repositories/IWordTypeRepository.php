<?php
namespace App\Contracts\Repositories;

use App\Models\WordType;

interface IWordTypeRepository extends IBaseRepository
{
    public function getVerbType(): ?WordType;
}
