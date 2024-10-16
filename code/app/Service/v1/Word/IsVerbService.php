<?php

namespace App\Service\v1\Word;

use App\Models\Word;
use App\Contracts\Repositories\{ IWordRepository, IWordTypeRepository, IDefintionRepository };

class IsVerbService
{
    public function __construct(
        private IWordRepository $wordRepository,
        private IWordTypeRepository $wordTypeRepository,
        private IDefintionRepository $defintionRepository
    ) {
    }
    /**
     * Check if the given word is a verb.
     *
     * @param string $word
     * @return bool
     */
    public function __invoke(Word|int $word): bool
    {
        if (is_numeric($word)) {
            $word = $this->wordRepository->findById($word);
        }

        if ($word == null) {
            return false;
        }

        $wordType = $this->wordTypeRepository->getVerbType();
        $hasDefinitionAsVerb = $this->defintionRepository->findByTypeForWord($word, $wordType);

        return $hasDefinitionAsVerb != null;
    }
}
