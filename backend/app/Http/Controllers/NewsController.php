<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetNewsRequest;
use App\Services\NewsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    public function __construct(private NewsService $newsService)
    {

    }
    public function get_news(): JsonResponse
    {
        $response = $this->newsService->get_news();
        if($response) {
            return response()->json(["message" => "Новости получены!", "status" => true, "news" => $response], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function find_news(GetNewsRequest $request): JsonResponse
    {
        $response = $this->newsService->find_news($request->all());
        if($response) {
            return response()->json(["message" => "Новость получена!", "status" => true, "news" => $response], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
