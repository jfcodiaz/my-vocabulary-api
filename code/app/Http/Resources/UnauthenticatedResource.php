<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnauthenticatedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @OA\Schema(
     *     schema="UnauthenticatedResource",
     *     type="object",
     *     title="UnauthenticatedResource",
     *     description="Resource returned when an action requries authentication and the user is not authenticated",
     *     @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Unauthenticated."
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
            'message' => 'Unauthenticated.',
        ];
    }
}
