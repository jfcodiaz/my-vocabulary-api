<?php

namespace App\Http\Resources\Api\v1\Controllers\Word\CreateWordController;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\v1\Models\WordResource;

/**
 * @OA\Schema(
 *     schema="CreateWordFailForExistsWordResource",
 *     type="object",
 *     title="CreateWordFailForExistsWordResource",
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
 *                 example="Creation failed: 'example' already exists."
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
class CreateWordFailForExistsWordResource extends JsonResource
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
        $creator = $this->resource->creator()->first();
        return [
            'success' => false,
            'errors' => [
                'word' =>[
                    'Creation failed: "' . $this->resource->word . '" already exists.'
                ]
            ],
            'data'=> [
                'word' => new WordResource($this->resource)
            ]
        ];
    }
}
