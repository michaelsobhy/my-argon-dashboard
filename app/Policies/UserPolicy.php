<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function delete(User $user, User $target_user)
    {
        return $user->id === 1 && $target_user->id !== 1;
    }

    public function forceDelete(User $user, User $target_user)
    {
        return $user->id === 1 && $target_user->id !== 1;
    }

    public function restore(User $user)
    {
        return $user->id === 1;
    }
}
