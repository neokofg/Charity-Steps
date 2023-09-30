<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLinkRequest;
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
}
