<?php
namespace App\Http\Resources\Api\v1\Controllers\Definitions;

use App\Http\Resources\Api\v1\Models\DefinitionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateDefinitionSuccessfullyResource extends JsonResource
{
    /**
     *
     * @OA\Schema(
     *     schema="CreateDefinitionSuccessfully",
     *     type="object",
     *     title="CreateDefinitionSuccessfully",
     *     properties={
     *         @OA\Property(
     *             property="success",
     *             type="boolean",
     *             description="Indicates if the operation was successful"
     *         ),
     *         @OA\Property(
     *             property="message",
     *             type="string",
     *             description="A message describing the result"
     *         ),
     *         @OA\Property(
     *             property="data",
     *             @OA\Property(
     *             type="object",
     *                 property="definition",
     *                 ref="#/components/schemas/DefinitionResource"
     *             )
     *         )
     *     }
     * )
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => 'Definition created successfully',
            'data' => [
                'definition' => new DefinitionResource($this->resource)
            ],
        ];
    }
}
