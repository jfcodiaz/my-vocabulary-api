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
