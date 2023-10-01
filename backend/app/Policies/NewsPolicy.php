<?php

namespace App\Policies;

use App\Models\Charity;
use App\Models\News;
use App\Models\User;

class NewsPolicy
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

    public function view($user, News $model): Response|bool
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

    public function update($user, News $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else if ($user->isCharityUser($model->charity_id) OR $user->isCompanyUser($model->company_id)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($user, News $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else if ($user->isCharityUser($model->charity_id) OR $user->isCompanyUser($model->company_id)) {
            return true;
        } else {
            return false;
        }
    }
}
