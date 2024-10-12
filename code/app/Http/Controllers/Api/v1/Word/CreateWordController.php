<?php
namespace App\Http\Controllers\Api\v1\Word;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Exceptions\WordExistsException;
use App\Service\v1\Word\CreateWordService;
use App\DTO\{ CreateWordData, WordExistsErrorDTO };
use App\Http\Requests\Auth\Api\v1\Word\CreateWordRequest;
use App\Http\Resources\Api\v1\Controllers\Word\CreateWordController\{ CreateWordSuccessfullyResource, WordExistsErrorResource };

class CreateWordController extends Controller
{
    /**
     * Handles the creation of a new word, ensuring no duplicates.
     *
     * @OA\Post(
     *     path="/api/v1/word",
     *     summary="Create a new word",
     *     description="Endpoint to create a new word in the vocabulary",
     *     operationId="createWord",
     *     tags={"Word"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateWordRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Word created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/CreateWordSuccessfullyResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity - Validation Error",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorValidationResource")
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Conflict - Word already exists",
     *         @OA\JsonContent(ref="#/components/schemas/CreateWordFailForExistsWordResource")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     *
     * @param CreateWordRequest $request
     * @param CreateWordService $createWord
     *
     * @return JsonResponse
     */
    public function __invoke(CreateWordRequest $request, CreateWordService $createWord): JsonResponse
    {
        $validated = $request->validated();
        $user = $request->user();
        try {
            $word = $createWord(new CreateWordData([
                'word' => $validated['word'],
                'creator_id' => $user->id,
            ]));
        } catch (WordExistsException $e) {
            return response()->json(new WordExistsErrorResource(new WordExistsErrorDTO([
                'word' => $e->getExistingWord(),
                'operation' => 'Creation'
            ])), 409);
        }

        return response()->json(new CreateWordSuccessfullyResource($word), 201);
    }
}
