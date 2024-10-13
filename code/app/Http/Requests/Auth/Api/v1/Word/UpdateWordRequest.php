<?php

namespace App\Http\Requests\Auth\Api\v1\Word;

use App\Service\IsOwnerOrAdminService;
use App\Http\Requests\Auth\Api\v1\Word\CreateWordRequest;

class UpdateWordRequest extends CreateWordRequest
{
    public function __construct(
        private IsOwnerOrAdminService $isOwnerOrAdminService
    ) {
        parent::__construct();
    }

    public function authorize()
    {
        return ($this->isOwnerOrAdminService)(
            auth()->user(),
            $this->route('word'),
            'creator_id'
        );
    }
}
