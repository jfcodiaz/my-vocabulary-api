<?php

namespace App\DTO;

use Illuminate\Support\Str;
use Spatie\DataTransferObject\DataTransferObject;

abstract class BaseDTO extends DataTransferObject
{
    /**
     * Convert the DTO properties to a snake_case array
     *
     * @return array
     */
    public function toArray(): array
    {
        return collect(get_object_vars($this))
            ->mapWithKeys(function ($value, $key) {
                return [Str::snake($key) => $value];
            })
            ->toArray();
    }
}
