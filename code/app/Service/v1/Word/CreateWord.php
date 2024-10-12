<?php

namespace App\Service\v1\Word;

use App\Models\Word;
use App\DTO\CreateWordData;
use App\Repositories\WordRepository;
use App\Exceptions\CreationFailForExistsWordException;

class CreateWord
{
    /**
     * CreateWord Service constructor.
     *
     * @param WordRepository $wordRepository
     */
    public function __construct(private WordRepository $wordRepository)
    {
    }

    /**
     * Create a new word
     *
     * @param CreateWordData $data
     *
     * @throws CreationFailForExistsWordException
     *
     * @return \App\Models\Word
     */
    public function __invoke(CreateWordData $data): Word
    {
        $existingWord = $this->wordRepository->findWordWithCreator($data->word);
        if ($existingWord) {
            throw new CreationFailForExistsWordException($existingWord);
        }

        $word = $this->wordRepository->create($data->toArray());

        return $word;
    }
}
