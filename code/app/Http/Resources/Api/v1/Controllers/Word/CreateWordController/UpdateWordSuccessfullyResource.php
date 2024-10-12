<?php

namespace App\Http\Resources\Api\v1\Controllers\Word\CreateWordController;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\v1\Models\WordResource;

class UpdateWordSuccessfullyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
