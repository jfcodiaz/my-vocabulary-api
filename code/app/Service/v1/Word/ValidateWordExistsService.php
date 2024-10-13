<?php
namespace App\Service\v1\Word;

use App\Exceptions\WordExistsException;
use App\Contracts\Repositories\IWordRepository;

class ValidateWordExistsService
{
    private IWordRepository $wordRepository;

    /**
     * ValidateWordExists constructor.
     *
     * @param IWordRepository $wordRepository
     */
    public function __construct(IWordRepository $wordRepository)
    {
        $this->wordRepository = $wordRepository;
    }

    /**
     * Validates if a word already exists in the repository.
     *
     * This method checks if the given word exists in the repository with its creator.
     * If the word exists, it throws a WordExistsException.
     *
     * @param string $word The word to be validated.
     *
     * @throws WordExistsException If the word already exists in the repository.
     */
    public function __invoke(string $word): void
    {
        $existingWord = $this->wordRepository->findWordWithCreator($word);
        if ($existingWord) {
            throw new WordExistsException($existingWord);
        };
    }
}
