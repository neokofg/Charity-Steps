<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterApproveRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegisterUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(private UserService $userService)
    {

    }


    public function register(RegisterRequest $request): JsonResponse
    {
        $response = $this->userService->register($request->all());
        if($response) {
            return response()->json(["message" => "Сообщение успешно отправлено!", "status" => true], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function register_approve(RegisterApproveRequest $request): JsonResponse
    {
        $response = $this->userService->register_approve($request->all());
        if($response) {
            return response()->json(["message" => "Аккаунт успешно подтвержден!", "status" => true, "token" => $response], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function register_update(RegisterUpdateRequest $request): JsonResponse
    {
        $user = Auth::user();
        $response = $this->userService->register_update($request->all(), $user);
        if($response) {
            return response()->json(["message" => "Аккаунт успешно создан!", "status" => true], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
