<?php
namespace App\Exceptions;

use Exception;
use App\Models\Word;

/**
 * Example usage:
 * This exception is thrown when an attempt to create a duplicate word is made.
 *
 * try {
 *     $wordService->create($data);
 * } catch (CreationFailForExistsWordException $e) {
 *      logError($e);
 *     // Handle the exception, e.g., log the error or notify the user
 * }
 */
class CreationFailForExistsWordException extends Exception
{
    const DEFAULT_MESSAGE = 'Creation failed: The word already exists.';
    private $existingWord;

    /**
     * Construct the exception.
     *
     * @param \App\Models\Word $existingWord The existing word that triggered the exception
     * @param string|null $message Custom message for the exception, default is defined if not provided.
     * @param int $code Exception code, default is 409.
     * @param \Exception|null $previous Previous exception for chaining exceptions.
     */
    public function __construct(Word $existingWord, $message = null, $code = 409, Exception $previous = null)
    {
        $this->existingWord = $existingWord;
        parent::__construct($message ?? self::DEFAULT_MESSAGE, $code, $previous);
    }

    /**
     * Get the existing word that caused the exception.
     *
     * @return Word
     */
    public function getExistingWord(): Word
    {
        return $this->existingWord;
    }
}
