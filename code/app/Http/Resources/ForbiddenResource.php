<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ForbiddenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @OA\Schema(
     *     schema="ForbiddenResource",
     *     type="object",
     *     title="ForbiddenResource",
     *     description="Resource returned when an action is forbidden",
     *     @OA\Property(
     *         property="message",
     *         type="string",
     *         example="This action is unauthorized."
     *     )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array<string, string>
     */
    public function toArray($request)
    {
        return [
            'message' => 'This action is unauthorized.',
        ];
    }
}
