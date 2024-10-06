<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ConjugationTypeResource",
 *     type="object",
 *     title="Conjugation Type Resource",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID of the conjugation type"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the conjugation type"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Description of the conjugation type"
 *     ),
 *     @OA\Property(
 *         property="examples",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/ConjugationTypeExampleResource"),
 *         description="Examples of the conjugation type"
 *     )
 * )
 */
class ConjugationTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'examples' => ConjugationTypeExampleResource::collection($this->examples),
        ];
    }
}
