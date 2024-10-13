<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class CreateWordData extends DataTransferObject
{
    /** @var string The specific word to be created */
    public string $word;

    /** @var int The ID of the user creating the word */
    public int $creatorId;

    public function toArray(): array
    {
        return [
            'word' => $this->word,
            'creator_id' => $this->creatorId
        ];
    }
}
