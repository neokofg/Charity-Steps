<?php

namespace App\Http\Controllers;

use App\Services\HistoriesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HistoriesController extends Controller
{
    public function __construct(private HistoriesService $historiesService)
    {

    }
    public function get_histories(): JsonResponse
    {
        $response = $this->historiesService->get_histories();
        if($response) {
            return response()->json(["message" => "Истории получены!", "status" => true, "histories" => $response], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
