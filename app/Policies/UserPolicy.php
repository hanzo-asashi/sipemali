<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     * @return void
     */
    public function viewAny(User $user): void
    {
        //return $user->isSuperadmin() || ($user->isAdmin() && $user->can('view any users'));
        return;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function view(User $user): Response|bool
    {
        return $user->can('view user');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function create(User $user): Response|bool
    {
        return $user->can('create users');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function update(User $user): Response|bool
    {
        return $user->can('update user');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function delete(User $user): Response|bool
    {
        return $user->can('delete user');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @return void
     */
    public function restore(User $user): void
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @return void
     */
    public function forceDelete(User $user): void
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @return Response|bool
     */
    public function manage(User $user): Response|bool
    {
        return $user->can('manage user');
    }
}
