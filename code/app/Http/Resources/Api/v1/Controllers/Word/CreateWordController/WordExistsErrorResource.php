<?php

namespace App\Http\Resources\Api\v1\Controllers\Word\CreateWordController;

use App\DTO\WordExistsErrorDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\v1\Models\WordResource;

/**
 * @OA\Schema(
 *     schema="WordExistsErrorResource",
 *     type="object",
 *     title="WordExistsErrorResource",
 *     @OA\Property(
 *         property="success",
 *         type="boolean",
 *         example=false
 *     ),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *         @OA\Property(
 *             property="word",
 *             type="array",
 *             @OA\Items(
 *                 type="string",
 *                 example="{Creation|Update} failed: 'example' already exists."
 *             )
 *         )
 *     ),
 *     @OA\Property(
 *         property="data",
 *         type="object",
 *         @OA\Property(
 *             property="word",
 *             ref="#/components/schemas/WordResource"
 *         )
 *     )
 * )
 */
class WordExistsErrorResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $creator = $this->resource->word->creator()->first();
        /**
         * @var  WordExistsErrorDTO
         */
        $resource = $this->resource;

        return [
            'success' => false,
            'errors' => [
                'word' => [
                    "{$resource->operation} failed: \"{$resource->word->word}\" already exists."
                ]
            ],
            'data' => [
                'word' => new WordResource($resource->word)
            ]
        ];
    }
}
