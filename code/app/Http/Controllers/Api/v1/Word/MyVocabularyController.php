<?php

namespace App\Http\Controllers\Api\v1\Word;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PaginatedResource;
use App\Http\Controllers\Api\v1\Controller;
use App\Http\Resources\Api\v1\Models\WordUserResource;
use App\Contracts\Repositories\IUserWordRepository;

class MyVocabularyController extends Controller
{
    /**
     * returns the paginated list of words that belong to the authenticated user
     *
     * @OA\Tag(
     *   name="WordUser",
     *   description="[My Vocabulary], List of words that belong to the authenticated user"
     * )
     * @OA\Schema(
     *   schema="PaginatedWordUserSchema",
     *   allOf={
     *     @OA\Schema(ref="#/components/schemas/PaginatedResource"),
     *   },
     *   @OA\Property(
     *     property="data",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/WordUserResource"),
     *     description="Array of WordUserResource objects"
     *   )
     * )
     *
     * @OA\Get(
     *   path="/api/v1/my-vocabulary",
     *   summary="Get paginated WordUser records",
     *   description="Returns paginated data for WordUserSchema.",
     *   operationId="getPaginatedWordUsers",
     *   tags={"WordUser"},
     *   @OA\Response(
     *     response=200,
     *     description="Paginated WordUser data",
     *     @OA\JsonContent(ref="#/components/schemas/PaginatedWordUserSchema")
     *   ),
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Contracts\Repositories\IUserWordRepository $userWordRepository
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, IUserWordRepository $userWordRepository): JsonResponse
    {
        $user = $request->user();
        $userWords = $userWordRepository->getUserWordsForUserIdWithPagination(
            perPage: config('app.pagination.default_limit'),
            userId: $user->id,
            page: (int) ($request->query('page') ?? 1)
        );

        return response()->json(new PaginatedResource($userWords, WordUserResource::class, $user));
    }
}
