<?php

namespace App\Http\Controllers\Api\v1\Word;

use App\Models\Word;
use App\DTO\WordExistsErrorDTO;
use App\Http\Controllers\Controller;
use App\Exceptions\WordExistsException;
use App\Service\v1\Word\UpdateWordService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\Api\v1\Word\UpdateWordRequest;
use App\Http\Resources\Api\v1\Controllers\Word\CreateWordController\{ UpdateWordSuccessfullyResource, WordExistsErrorResource};

class UpdateWordController extends Controller
{
    /**
     * Update the specified word in storage.
     *
     * @OA\Put(
     *     path="/api/v1/word/{word}",
     *     summary="Update an existing word",
     *     tags={"Word"},
     *     @OA\Parameter(
     *         name="word",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="The word id to update"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"word"},
     *             @OA\Property(property="word", type="string", example="example")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Word updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/UpdateWordSuccessfullyResource")
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Word already exists",
     *         @OA\JsonContent(ref="#/components/schemas/WordExistsErrorResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\AdditionalProperties(type="array", @OA\Items(type="string"))
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(ref="#/components/schemas/ForbiddenResource")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource")
     *     ),
     * )
     *
     * @param  UpdateWordRequest  $request
     * @param  Word  $word
     * @param  UpdateWordService  $updateWord
     *
     * @return JsonResponse
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
