<?php

namespace App\DTO;

use App\Models\Word;
use Spatie\DataTransferObject\DataTransferObject;

class WordExistsErrorDTO extends DataTransferObject
{
    public string $operation;
    public Word $word;

}
