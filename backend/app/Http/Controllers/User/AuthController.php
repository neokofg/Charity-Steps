<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {

    }

}
