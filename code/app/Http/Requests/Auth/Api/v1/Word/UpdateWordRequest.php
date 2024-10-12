<?php

namespace App\Http\Requests\Auth\Api\v1\Word;

use App\Http\Requests\Auth\Api\v1\Word\CreateWordRequest;

class UpdateWordRequest extends CreateWordRequest
{
    public function authorize()
    {
        // Checks if the user is authenticated
        $user = auth()->user();

        // Return false if no authenticated user is found
        if (!$user) {
            return false;
        }

        // Uses explicit model binding to inject the Word instance
        $word = $this->route('word');

        // Checks if the user is an admin or if the user is the creator of the word
        return $user->isAdmin() || ($word && $word->creator_id === $user->id);
    }
}
