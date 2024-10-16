<?php
namespace App\Http\Resources\Api\v1\Models;

use Illuminate\Http\Resources\Json\JsonResource;

class DefinitionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
    * @OA\Schema(
    *     schema="DefinitionResource",
    *     type="object",
    *     title="DefinitionResource",
    *     description="Definition resource representation",
    *     @OA\Property(
    *         property="id",
    *         type="integer",
    *         description="ID of the definition"
    *     ),
    *     @OA\Property(
    *         property="wordId",
    *         type="integer",
    *         description="ID of the word"
    *     ),
    *     @OA\Property(
    *         property="wordTypeId",
    *         type="integer",
    *         description="ID of the word type"
    *     ),
    *     @OA\Property(
    *         property="definition",
    *         type="string",
    *         description="The definition text"
    *     ),
    *     @OA\Property(
    *         property="creatorId",
    *         type="integer",
    *         description="ID of the creator"
    *     ),
    *     @OA\Property(
    *         property="creator",
    *         ref="#/components/schemas/User",
    *         description="Creator of the definition"
    *     )
    * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this);
        return [
            'id' => $this->id,
            'wordId' => $this->word_id,
            'wordTypeId' => $this->word_type_id,
            'definition' => $this->definition,
            'creatorId' => $this->creator_id,
            'creator' => new UserResource($this->creator),
            'examples' => $this->whenLoaded('examples')
        ];
    }
}
