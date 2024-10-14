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
