<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailApproveRequest;
use App\Http\Requests\EmailUpdateRequest;
use App\Http\Requests\FillCharityRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UploadHistoryRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {

    }
    public function get_user(): JsonResponse
    {
        $user = Auth::user();
        $response = $this->userService->get_user($user);
        if($response) {
            return response()->json(["message" => "Пользователь получен!", "status" => true, "user" => $response], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update_user(UserUpdateRequest $request): JsonResponse
    {
        $user = Auth::user();
        $response = $this->userService->user_update($request->validated(), $user);
        if($response) {
            return response()->json(["message" => "Аккаунт успешно обновлен!", "status" => true], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update_email(EmailUpdateRequest $request): JsonResponse
    {
        $user = Auth::user();
        $response = $this->userService->user_update_email($request->all(), $user);
        if($response) {
            return response()->json(["message" => "Сообщение успешно отправлено!", "status" => true], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update_email_approve(EmailApproveRequest $request): JsonResponse
    {
        $user = Auth::user();
        $response = $this->userService->user_update_email_approve($request->all(), $user);
        if($response) {
            return response()->json(["message" => "Почта успешно обновлена!", "status" => true], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update_avatar(UpdateAvatarRequest $request): JsonResponse
    {
        $user = Auth::user();
        $file = $request->file('file');
        $response = $this->userService->update_avatar($file, $user);
        if($response) {
            return response()->json(["message" => "Аватар успешно обновлен!", "status" => true], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function fill_charity(FillCharityRequest $request): JsonResponse
    {
        $user = Auth::user();
        $response = $this->userService->fill_charity($request->all(), $user);
        if($response) {
            return response()->json(["message" => "Деньги были успешно отправлены!", "status" => true], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function upload_history(UploadHistoryRequest $request): JsonResponse
    {
        $user = Auth::user();
        $response = $this->userService->upload_history($request->all(), $user);
        if($response) {
            return response()->json(["message" => "История успешно опубликована!", "status" => true], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
