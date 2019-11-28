<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryPolicy
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
        return $user->canDo('ADD_GALLERIES');
    }

    public function edit (User $user)
    {
        return $user->canDo('EDIT_GALLERIES');
    }

    public function update (User $user)
    {
        return $user->canDo('UPDATE_GALLERIES');
    }

    public function delete (User $user)
    {
        return $user->canDo('DELETE_GALLERIES');
    }
}
