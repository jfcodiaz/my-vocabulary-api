<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class IsOwnerOrAdminService
{
    /**
     * Checks if the user is the owner of the resource or an admin.
     *
     * @param User $user The user to verify.
     * @param Model $model The model that contains the owner field.
     * @param string $ownerFieldKey The key of the field identifying the owner in the model, defaults to 'user_id'.
     * @return bool Returns true if the user is an admin or the owner of the model, otherwise false.
     */
    public function __invoke(User $user, Model $model, string $ownerFieldKey = 'user_id'): bool
    {
        return $user->isAdmin() || ($model->{$ownerFieldKey} === $user->id);
    }
}
