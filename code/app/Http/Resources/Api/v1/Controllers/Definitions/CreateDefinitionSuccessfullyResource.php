<?php
namespace App\Http\Resources\Api\v1\Controllers\Definitions;

use App\Http\Resources\Api\v1\Models\DefinitionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateDefinitionSuccessfullyResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'success' => true,
            'message' => 'Definition created successfully',
            'data' => [
                'definition' => new DefinitionResource($this->resource)
            ],
        ];
    }
}
