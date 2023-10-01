<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny($user): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param AdminUser $user
     * @param User $model
     * @return Response|bool
     */
    public function view($user, User $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else if ($user->id == $model->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param AdminUser $user
     * @return Response|bool
     */
    public function create($user): Response|bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param AdminUser $user
     * @param User $model
     * @return Response|bool
     */
    public function update($user, User $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else if ($user->id == $model->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param AdminUser $user
     * @param User $model
     * @return Response|bool
     */
    public function delete($user, User $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else if ($user->id == $model->id) {
            return true;
        } else {
            return false;
        }
    }
}
