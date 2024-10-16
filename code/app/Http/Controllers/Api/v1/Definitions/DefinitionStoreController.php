<?php
namespace App\Http\Controllers\Api\v1\Definitions;

use App\DTO\CreateDefinitionDTO;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Service\v1\Definition\CreateDefinitionService;
use App\Http\Requests\Auth\Api\v1\Definitions\CreateDefinitionRequest;
use App\Http\Resources\Api\v1\Controllers\Definitions\CreateDefinitionSuccessfullyResource;

class DefinitionStoreController extends Controller
{
    /**
     * Create a new definition.
     * @OA\Post(
     *     path="/api/v1/definitions",
     *     summary="Store a new definition",
     *     description="Create a new definition in the vocabulary API",
     *     operationId="storeDefinition",
     *     tags={"Definitions"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="wordId",
     *                 type="integer",
     *                 description="The term to be defined"
     *             ),
     *             @OA\Property(
     *                property="wordTypeId",
     *               type="integer",
     *              description="The type of the term to be defined"
     *           ),
     *             @OA\Property(
     *                 property="definition",
     *                 type="string",
     *                 description="The definition of the term",
     *                 example="A word that is used to name a person, place, thing, or idea"
     *             ),
     *             @OA\Property(
     *                property="verbBaseId",
     *                type="integer",
     *                description="The base form of the verb optional if wordTypeId is not a verb"
     *           ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Definition created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 type="integer",
     *                 description="ID of the created definition"
     *             ),
     *             @OA\Property(
     *                 property="term",
     *                 type="string",
     *                 description="The term that was defined"
     *             ),
     *             @OA\Property(
     *                 property="definition",
     *                 type="string",
     *                 description="The definition of the term"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Some errors in request data",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorValidationResource")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(ref="#/components/schemas/ForbiddenResource")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *        @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResource")
     *     )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(CreateDefinitionRequest $request, CreateDefinitionService $createDefinition): JsonResponse
    {
        $validatedData = $request->validated();
        $validatedData['creatorId'] = $request->user()->id;
        $dto = new CreateDefinitionDTO($validatedData);

        $definition = $createDefinition($dto);

        return response()->json(new CreateDefinitionSuccessfullyResource($definition), 201);

    }
}
