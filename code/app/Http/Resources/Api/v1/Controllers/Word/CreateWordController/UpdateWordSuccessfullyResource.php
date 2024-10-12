<?php

namespace App\Http\Resources\Api\v1\Controllers\Word\CreateWordController;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\v1\Models\WordResource;

class UpdateWordSuccessfullyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @OA\Schema(
     *     schema="UpdateWordSuccessfullyResource",
     *     type="object",
     *     title="Update WordSuccessfullyResource",
     *     description="Resource returned when a word is updated successfully",
     *     @OA\Property(
     *         property="status",
     *         type="string",
     *         example="success"
     *     ),
     *     @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Word updated successfully"
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
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'status' => 'success',
            'message' => 'Word updated successfully',
            'data' => [
                'word' => new WordResource($this->resource)
            ],
        ];
    }
}
