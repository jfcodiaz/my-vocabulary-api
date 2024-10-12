<?php

namespace App\Http\Controllers\Api\v1\Word;

use App\Models\Word;
use App\DTO\WordExistsErrorDTO;
use App\Http\Controllers\Controller;
use App\Exceptions\WordExistsException;
use App\Service\v1\Word\UpdateWordService;
use Illuminate\Http\{ Request, JsonResponse };
use App\Http\Requests\Auth\Api\v1\Word\UpdateWordRequest;
use App\Http\Resources\Api\v1\Controllers\Word\CreateWordController\{ UpdateWordSuccessfullyResource, WordExistsErrorResource};

class UpdateWordController extends Controller
{
    /**
     * Update the specified word in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     *
     * @return UpdateWordSuccessfullyResource
     */
    public function __invoke(UpdateWordRequest $request, Word $word, UpdateWordService $updateWord): JsonResponse
    {
        $request->validate([
            'word' => 'required|string|max:255'
        ]);

        try {
            $updateWord($word, $request->input('word'));

        } catch (WordExistsException $e) {
            return response()->json(new WordExistsErrorResource(
                new WordExistsErrorDTO([
                'word' => $e->getExistingWord(),
                'operation' => 'Update'
            ])), 409);
        }

        return response()->json(new UpdateWordSuccessfullyResource($word), 200);
    }
}
