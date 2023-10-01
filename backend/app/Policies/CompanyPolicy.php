<?php

namespace App\Policies;

use App\Models\Company;

class CompanyPolicy
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

    public function view($user, Company $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else if ($user->isCompanyUser($model->id)) {
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

    public function update($user,Company $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else if ($user->isCompanyUser($model->id)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($user, Company $model): Response|bool
    {
        if($user->isAdmin()){
            return true;
        } else {
            return false;
        }
    }
}
