<?php
namespace App\Service\v1\Word;

use App\Models\Word;
use App\Repositories\WordRepository;
use App\Exceptions\WordExistsException;
use App\Contracts\Repositories\IWordRepository;

class UpdateWordService
{
    private $wordRepository;

    public function __construct(IWordRepository $wordRepository)
    {
        /** @var WordRepository */
        $this->wordRepository = $wordRepository;
    }

    public function __invoke(Word $word, string $newWordValue): ?Word
    {
        /** @var Word */
        $wordInDb = $this->wordRepository->findByWordValue($newWordValue);

        if ($wordInDb !== null) {
            throw new WordExistsException($wordInDb);
        }

        $word->word = $newWordValue;
        $this->wordRepository->save($word);

        return $word;
    }
}
