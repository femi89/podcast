<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Album;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlbumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the album can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the album can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Album  $model
     * @return mixed
     */
    public function view(User $user, Album $model)
    {
        return true;
    }

    /**
     * Determine whether the album can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the album can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Album  $model
     * @return mixed
     */
    public function update(User $user, Album $model)
    {
        return true;
    }

    /**
     * Determine whether the album can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Album  $model
     * @return mixed
     */
    public function delete(User $user, Album $model)
    {
        return true;
    }

    /**
     * Determine whether the album can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Album  $model
     * @return mixed
     */
    public function restore(User $user, Album $model)
    {
        return false;
    }

    /**
     * Determine whether the album can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Album  $model
     * @return mixed
     */
    public function forceDelete(User $user, Album $model)
    {
        return false;
    }
}
