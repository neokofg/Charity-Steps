<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Company\CompanyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("auth")->group(function () {
   Route::post("/register", [AuthController::class, "register"]);
   Route::post("/register/approve",[AuthController::class, "register_approve"]);
    Route::post("/login", [AuthController::class, "login"]);
   Route::middleware('auth:sanctum')->post("/register/update", [AuthController::class, "register_update"]);
});

Route::prefix("user")->middleware('auth:sanctum')->group(function () {
    Route::get('/get', [UserController::class, "get_user"]);
    Route::post('/update', [UserController::class, "update_user"]);
    Route::post('/update/avatar', [UserController::class, "update_avatar"]);
    Route::post('/update/email', [UserController::class, "update_email"]);
    Route::post('/update/email/approve', [UserController::class, "update_email_approve"]);
});

Route::prefix("company")->middleware('auth:sanctum')->group(function () {
    Route::post("/create_link", [CompanyController::class, "create_link"]);
});

