<?php
namespace App\Service\v1\Word;

use App\Models\Word;
use App\Contracts\Repositories\IWordRepository;

class UpdateWordService
{
    public function __construct(
        private IWordRepository $wordRepository,
        private ValidateWordExistsService $validateWordExists
    ) {
    }

    /**
     * Update a word
     *
     * @param Word $word
     * @param string $newWordValue
     * @return Word
     */
    public function __invoke(Word $word, string $newWordValue): ?Word
    {
        ($this->validateWordExists)($newWordValue);
        $word->word = $newWordValue;
        $this->wordRepository->save($word);

        return $word;
    }
}
