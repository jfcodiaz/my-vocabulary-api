<?php
namespace App\Http\Resources\Api\v1\Models;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * Includes user ID, name, and conditionally includes email based on permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Ensure there's a logged-in user before checking permissions
        $user = $request->user();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->when(
                $user && $user->can('viewEmail', $this->resource),
                $this->email
            ),
        ];
    }
}
