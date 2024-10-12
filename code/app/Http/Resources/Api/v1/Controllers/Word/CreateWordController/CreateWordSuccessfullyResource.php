<?php

namespace App\Http\Resources\Api\v1\Controllers\Word\CreateWordController;

use App\Http\Resources\Api\v1\Models\WordResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="CreateWordSuccessfullyResource",
 *     type="object",
 *     title="Create Word Successfully Resource",
 *     @OA\Property(
 *         property="success",
 *         type="boolean",
 *         example=true
 *     ),
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         example="Word created successfully"
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
class CreateWordSuccessfullyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => 'Word created successfully',
            'data' => [
                'word' => new WordResource($this->resource)
            ],
        ];
    }
}
