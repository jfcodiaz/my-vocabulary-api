<?php
namespace App\Http\Resources\Api\v1\Models;

use Illuminate\Http\Resources\Json\JsonResource;

class WordUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @OA\Schema(
     *     schema="WordUserResource",
     *     type="object",
     *     title="WordUserResource",
     *     @OA\Property(
     *         property="word",
     *         ref="#/components/schemas/WordResource"
     *     ),
     *     @OA\Property(
     *         property="mine",
     *         type="boolean",
     *         description="Indicates if the word belongs to the authenticated user"
     *     ),
     *     @OA\Property(
     *         property="created_at",
     *         type="string",
     *         format="date-time",
     *         description="The date and time when the word was created"
     *     )
     * )
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();

        return [
            'word' => new WordResource($this->word),
            'mine' => $this->word->creator_id === $user->id,
            'created_at' => $this->created_at,
        ];
    }
}
