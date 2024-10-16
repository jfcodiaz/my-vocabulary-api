<?php

namespace App\Http\Resources\Api\v1\Models;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="WordResource",
 *     type="object",
 *     title="Word",
 *     description="WordResource",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID of the word"
 *     ),
 *     @OA\Property(
 *         property="word",
 *         type="string",
 *         description="The word itself"
 *     ),
 *     @OA\Property(
 *         property="creatorId",
 *         type="integer",
 *         description="ID of the creator"
 *     ),
 *     @OA\Property(
 *         property="creator",
 *         ref="#/components/schemas/User"
 *     )
 * )
 */
class WordResource extends JsonResource
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
            'word' => $this->word,
            'creator_id' => $this->creator_id,
            'creator' => new UserResource($this->creator()->first()),
        ];
    }
}
