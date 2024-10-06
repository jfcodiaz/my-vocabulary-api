<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ConjugationTypeExampleResource",
 *     type="object",
 *     title="Conjugation Type Example Resource",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID of the conjugation type example"
 *     ),
 *     @OA\Property(
 *         property="example_sentence",
 *         type="string",
 *         description="example of the conjugation type example"
 *     ),
 *     @OA\Property(
 *         property="conjugation_type_id",
 *         type="array",
 *         @OA\Items(type="string"),
 *         description="Id from conjugation type"
 *     )
 * )
 */
class ConjugationTypeExampleResource extends JsonResource
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
            'example_sentence' => $this->example_sentence,
            'conjugation_type_id' => $this->conjugation_type_id,
        ];
    }
}
