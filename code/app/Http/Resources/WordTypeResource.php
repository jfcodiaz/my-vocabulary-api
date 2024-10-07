<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WordTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param  Request  $request
     * @return array
     * @OA\Schema(
     *     schema="WordType",
     *     type="object",
     *     title="WordType",
     *     description="A type of word",
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         description="The ID of the word type"
     *     ),
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         description="The name of the word type"
     *     ),
     *     @OA\Property(
     *         property="description",
     *         type="string",
     *         description="The description of the word type"
     *     )
     * )
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description
        ];
    }
}
