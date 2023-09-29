<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("auth")->group(function () {
   Route::post("/register", [AuthController::class, "register"]);
   Route::post("/register/approve",[AuthController::class, "register_approve"]);
   Route::middleware('auth:sanctum')->post("/register/update", [AuthController::class, "register_update"]);
});
