<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Podcast;
use Illuminate\Auth\Access\HandlesAuthorization;

class PodcastPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the podcast can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the podcast can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Podcast  $model
     * @return mixed
     */
    public function view(User $user, Podcast $model)
    {
        return true;
    }

    /**
     * Determine whether the podcast can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the podcast can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Podcast  $model
     * @return mixed
     */
    public function update(User $user, Podcast $model)
    {
        return true;
    }

    /**
     * Determine whether the podcast can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Podcast  $model
     * @return mixed
     */
    public function delete(User $user, Podcast $model)
    {
        return true;
    }

    /**
     * Determine whether the podcast can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Podcast  $model
     * @return mixed
     */
    public function restore(User $user, Podcast $model)
    {
        return false;
    }

    /**
     * Determine whether the podcast can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Podcast  $model
     * @return mixed
     */
    public function forceDelete(User $user, Podcast $model)
    {
        return false;
    }
}
