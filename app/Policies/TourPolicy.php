<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TourPolicy
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
        return $user->canDo('ADD_TOURS');
    }

    public function edit (User $user)
    {
        return $user->canDo('EDIT_TOURS');
    }

    public function update (User $user)
    {
        return $user->canDo('UPDATE_TOURS');
    }

    public function delete (User $user)
    {
        return $user->canDo('DELETE_TOURS');
    }
}
