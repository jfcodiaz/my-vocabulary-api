<?php

namespace App\Http\Controllers\Api\v1;

use OpenApi\Annotations as OA;
use App\Models\ConjugationType;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConjugationTypeResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @OA\Get(
 *     path="/api/v1/conjugation-types",
 *     summary="Get a list of conjugation types",
 *     tags={"Conjugation Types"},
 *     security={{ "sanctum": {} }},
 *     @OA\Response(
 *         response=200,
 *         description="A list of conjugation types with examples",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                property="data",
 *                type="array",
 *                @OA\Items(ref="#/components/schemas/ConjugationType")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error"
 *     )
 * )
 *
 */
class ConjugationTypeController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $conjugationTypes = ConjugationType::with('examples')->get();
        return ConjugationTypeResource::collection($conjugationTypes);
    }
}
