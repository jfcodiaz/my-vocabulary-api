<?php
namespace App\Http\Resources\Api\v1\Models;

use Illuminate\Http\Resources\Json\JsonResource;

class DefinitionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //dd($this);
        return [
            'id' => $this->id,
            'wordId' => $this->word_id,
            'wordTypeId' => $this->word_type_id,
            'definition' => $this->definition,
            'creatorId' => $this->creator_id,
            'creator' => new UserResource($this->creator),
            'examples' => $this->whenLoaded('examples')
        ];
    }
}
