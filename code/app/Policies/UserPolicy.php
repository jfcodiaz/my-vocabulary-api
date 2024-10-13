<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    /*
     * Determine whether the user can view the email of another user.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
    */
    public function viewUsersEmails(User $user)
    {
        return $user->isAdmin();
    }
}
