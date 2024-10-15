<?php
namespace App\DTO;

class CreateDefinitionDTO extends BaseDTO
{
    public int $wordId;
    public int $wordTypeId;
    public string $definition;
    public int $creatorId;
}
