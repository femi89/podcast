<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Guest;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the guest can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the guest can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Guest  $model
     * @return mixed
     */
    public function view(User $user, Guest $model)
    {
        return true;
    }

    /**
     * Determine whether the guest can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the guest can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Guest  $model
     * @return mixed
     */
    public function update(User $user, Guest $model)
    {
        return true;
    }

    /**
     * Determine whether the guest can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Guest  $model
     * @return mixed
     */
    public function delete(User $user, Guest $model)
    {
        return true;
    }

    /**
     * Determine whether the guest can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Guest  $model
     * @return mixed
     */
    public function restore(User $user, Guest $model)
    {
        return false;
    }

    /**
     * Determine whether the guest can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Guest  $model
     * @return mixed
     */
    public function forceDelete(User $user, Guest $model)
    {
        return false;
    }
}
