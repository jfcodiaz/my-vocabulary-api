<?php
namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PaginatedResource extends ResourceCollection
{
    /**
     * Constructor para recibir el Resource que será aplicado a los datos.
     *
     * @param mixed $resource
     * @param string $collects Name of the Resource class to be applied to the data.
     */
    public function __construct(
        public $resource,
        public $collects
    ) {
        parent::__construct($this->resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @OA\Schema(
     *     schema="PaginatedResource",
     *     type="object",
     *     @OA\Property(
     *         property="data",
     *         type="array",
     *         @OA\Items(
     *             type="object"
     *         )
     *     ),
     *     @OA\Property(
     *         property="meta",
     *         type="object",
     *         @OA\Property(property="current_page", type="integer"),
     *         @OA\Property(property="first_page_url", type="string"),
     *         @OA\Property(property="from", type="integer"),
     *         @OA\Property(property="last_page", type="integer"),
     *         @OA\Property(property="last_page_url", type="string"),
     *         @OA\Property(property="next_page_url", type="string"),
     *         @OA\Property(property="path", type="string"),
     *         @OA\Property(property="per_page", type="integer"),
     *         @OA\Property(property="prev_page_url", type="string"),
     *         @OA\Property(property="to", type="integer"),
     *         @OA\Property(property="total", type="integer")
     *     )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($item): object {
                return new $this->collects($item);
            }),
            'meta' => [
                'current_page' => $this->currentPage(),
                'first_page_url' => $this->url(1),
                'from' => $this->firstItem(),
                'last_page' => $this->lastPage(),
                'last_page_url' => $this->url($this->lastPage()),
                'next_page_url' => $this->nextPageUrl(),
                'path' => $this->path(),
                'per_page' => $this->perPage(),
                'prev_page_url' => $this->previousPageUrl(),
                'to' => $this->lastItem(),
                'total' => $this->total(),
            ]

        ];
    }
}
