<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyNewsRequest;
use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\GetCompanyRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    public function __construct(private CompanyService $companyService)
    {

    }

    public function get_company(GetCompanyRequest $request)
    {
        $user = Auth::user();
        $response = $this->companyService->get_company($request->all(),$user);
        if($response) {
            return response()->json(["message" => "Компания получена!", "status" => true, "company" => $response], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create_link(CreateLinkRequest $request): JsonResponse
    {
        $u = Auth::user();
        $response = $this->companyService->create_link($request->all(), $u);
        if($response) {
            return response()->json(["message" => "Ссылка получена!", "status" => true, "link" => $response], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create_news(CreateCompanyNewsRequest $request): JsonResponse
    {
        $u = Auth::user();
        $response = $this->companyService->create_news($request->all(), $u);
        if($response) {
            return response()->json(["message" => "Новость успешно создана!", "status" => true], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update_avatar(UpdateAvatarRequest $request): JsonResponse
    {
        $u = Auth::user();
        $response = $this->companyService->update_avatar($request->all(), $u);
        if($response) {
            return response()->json(["message" => "Аватар успешно обновлен!", "status" => true], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
