<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityDontFoundResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @OA\Schema(
     *     schema="EntityDontFound",
     *     type="object",
     *     title="Entity Don't Found",
     *     properties={
     *         @OA\Property(
     *             property="message",
     *             type="string",
     *             example="Record not found."
     *         )
     *     }
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'message' => 'Record not found.',
        ];
    }
}
