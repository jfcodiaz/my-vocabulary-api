<?php
namespace App\Http\Controllers\Api\v1\Word;

use App\DTO\CreateWordData;
use Illuminate\Http\JsonResponse;
use App\Service\v1\Word\CreateWord;
use App\Http\Controllers\Controller;
use App\Exceptions\CreationFailForExistsWordException;
use App\Http\Requests\Auth\Api\v1\Word\CreateWordRequest;
use App\Http\Resources\Api\v1\Controllers\Word\CreateWordController\CreateWordFailForExistsWordResource;
use App\Http\Resources\Api\v1\Controllers\Word\CreateWordController\CreateWordSuccessfullyResource;

class CreateWordController extends Controller
{
    /**
     * Handles the creation of a new word, ensuring no duplicates.
     *
     * @param CreateWordRequest $request
     * @param CreateWord $createWord
     *
     * @return JsonResponse
     */
    public function __invoke(CreateWordRequest $request, CreateWord $createWord): JsonResponse
    {
        $validated = $request->validated();
        $user = $request->user();
        try {
            $word = $createWord(new CreateWordData([
                'word' => $validated['word'],
                'creator_id' => $user->id,
            ]));
        } catch (CreationFailForExistsWordException $e) {
            return response()->json(new CreateWordFailForExistsWordResource($e->getExistingWord()), 409);
        }

        return response()->json(new CreateWordSuccessfullyResource($word), 201);
    }
}
