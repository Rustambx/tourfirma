<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
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

    public function save (User $user)
    {
        return $user->canDo('ADD_NEWS');
    }

    public function edit (User $user)
    {
        return $user->canDo('EDIT_NEWS');
    }

    public function update (User $user)
    {
        return $user->canDo('UPDATE_NEWS');
    }

    public function delete (User $user)
    {
        return $user->canDo('DELETE_NEWS');
    }
}
