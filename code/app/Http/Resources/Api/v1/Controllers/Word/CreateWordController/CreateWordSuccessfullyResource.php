<?php

namespace App\Http\Resources\Api\v1\Controllers\Word\CreateWordController;

use App\Http\Resources\Api\v1\Models\WordResource;
use Illuminate\Http\Resources\Json\JsonResource;


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
