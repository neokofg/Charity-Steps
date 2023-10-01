<?php

namespace App\Policies;

use App\Models\Charity;
use App\Models\User;

class CharityPolicy
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

    public function view($user, Charity $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else if ($user->isCharityUser($model->id)) {
            return true;
        } else {
            return false;
        }
    }

    public function create($user): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else {
            return false;
        }
    }

    public function update($user,Charity $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else if ($user->isCharityUser($model->id)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($user, Charity $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else {
            return false;
        }
    }
}
