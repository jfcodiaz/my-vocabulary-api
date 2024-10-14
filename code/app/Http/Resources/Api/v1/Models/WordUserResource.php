<?php
namespace App\Http\Resources\Api\v1\Models;

use Illuminate\Http\Resources\Json\JsonResource;

class WordUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();

        return [
            'word' => new WordResource($this->word),
            'user_id' => $this->user_id,
            'mine' => $this->word->creator_id === $user->id,
            'created_at' => $this->created_at,
        ];
    }
}
