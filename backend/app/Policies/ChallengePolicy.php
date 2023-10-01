<?php

namespace App\Policies;

use App\Models\Challenge;
use App\Models\User;

class ChallengePolicy
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
        return true;
    }

    public function view($user, Challenge $model): Response|bool
    {
        return true;
    }

    public function create($user): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else {
            return false;
        }
    }

    public function update($user,Challenge $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($user, Challenge $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else {
            return false;
        }
    }
}
