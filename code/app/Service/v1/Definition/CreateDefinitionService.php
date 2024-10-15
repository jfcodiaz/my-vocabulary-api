<?php

namespace App\Service\v1\Definition;

use App\DTO\CreateDefinitionDTO;
use App\Models\Definition;

class CreateDefinitionService
{
    public function __invoke(
        CreateDefinitionDTO $defintion,
    ): Definition {
        return Definition::create($defintion->toArray());
    }
}
