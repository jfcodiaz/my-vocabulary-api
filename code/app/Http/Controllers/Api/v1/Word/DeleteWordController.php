<?php

namespace App\Http\Controllers\Api\v1\Word;

use App\Models\Word;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Api\v1\Word\DeleteWordRequest;

class DeleteWordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @OA\Delete(
     *     path="/api/v1/word/{id}",
     *     summary="Delete a word",
     *     description="Deletes a word from the vocabulary by its ID.",
     *     operationId="deleteWord",
     *     tags={"Word"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the word to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\MediaType(
     *             mediaType="application/json"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Word deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Word not found",
     *         @OA\JsonContent(ref="#/components/schemas/EntityDontFound")
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
     * @param  int  $id
     *
     * @return Response
     */
    public function __invoke(DeleteWordRequest $request, Word $word)
    {
        $word->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
