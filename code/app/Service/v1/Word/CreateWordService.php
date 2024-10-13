<?php

namespace App\Service\v1\Word;

use App\Models\Word;
use App\DTO\CreateWordData;
use App\Repositories\WordRepository;
use App\Exceptions\WordExistsException;

class CreateWordService
{
    /**
     * CreateWord Service constructor.
     *
     * @param WordRepository $wordRepository
     */
    public function __construct(
        private WordRepository $wordRepository,
        private ValidateWordExistsService $validateWordExists
    ) {
    }

    /**
     * Create a new word
     *
     * @param CreateWordData $data
     *
     * @throws WordExistsException
     *
     * @return \App\Models\Word
     */
    public function __invoke(CreateWordData $data): Word
    {
        ($this->validateWordExists)($data->word);
        $word = $this->wordRepository->create($data->toArray());

        return $word;
    }
}
