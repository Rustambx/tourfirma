<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
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
        return $user->canDo('ADD_COUNTRIES');
    }

    public function edit (User $user)
    {
        return $user->canDo('EDIT_COUNTRIES');
    }

    public function update (User $user)
    {
        return $user->canDo('UPDATE_COUNTRIES');
    }

    public function delete (User $user)
    {
        return $user->canDo('DELETE_COUNTRIES');
    }
}
