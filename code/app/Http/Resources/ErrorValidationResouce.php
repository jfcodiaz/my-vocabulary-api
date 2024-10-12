<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @OA\Schema(
 *     schema="ErrorValidationResource",
 *     type="object",
 *     title="ErrorValidationResource",
 *     description="Validation error response",
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         example="Validation Error"
 *     ),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *         additionalProperties=@OA\Property(type="array", @OA\Items(type="string")),
 *         example={
 *             "field_name": {
 *                 "The field_name field is required."
 *             }
 *         }
 *     )
 * )
 */
class ErrorValidationResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'message' => 'Validation Error',
            'errors' => $this->errors(),
        ];
    }

    /**
     * Get the validation errors.
     *
     * @return array
     */
    protected function errors()
    {
        return $this->resource->errors();
    }
}
