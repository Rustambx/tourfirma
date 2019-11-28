<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SliderPolicy
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
        return $user->canDo('ADD_SLIDERS');
    }

    public function edit (User $user)
    {
        return $user->canDo('EDIT_SLIDERS');
    }

    public function update (User $user)
    {
        return $user->canDo('UPDATE_SLIDERS');
    }

    public function delete (User $user)
    {
        return $user->canDo('DELETE_SLIDERS');
    }
}
