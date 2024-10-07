<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\WordType;
use App\Http\Resources\WordTypeResource; // Importar el Resource
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WordTypeController extends Controller
{
    /**
     * Display a listing of the word types.
     *
     * @return JsonResponse
     * @OA\Get(
     *     path="/api/v1/word-types",
     *     operationId="getWordTypes",
     *     tags={"WordTypes"},
     *     summary="Get list of word types",
     *     description="Returns list of word types",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/WordType")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     )
     * )
     */
    public function __invoke(): AnonymousResourceCollection
    {
        $wordTypes = WordType::all();
        return WordTypeResource::collection($wordTypes);
    }
}
