<?php

namespace App\Http\Resources\Api\v1\Controllers\Word\CreateWordController;

use App\Http\Resources\Api\v1\Models\WordResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
