<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CallBackRequest;
use App\Http\Requests\WalletFillRequest;
use App\Models\CompanyFills;
use App\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Qiwi\Api\BillPayments;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $paymentService)
    {

    }
    public function wallet_fill(WalletFillRequest $request): JsonResponse
    {
        $user = Auth::user();
        $response = $this->paymentService->wallet_fill($request->all(), $user);
        if($response) {
            return response()->json(["message" => "Ссылка для оплаты получена!", "status" => true, "link" => $response], Response::HTTP_OK);
        } else {
            return response()->json(["message" => "Произошла ошибка!", "status" => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function callback(CallBackRequest $request): Bool
    {
        try {
            $c_f = CompanyFills::where("id", "=", $request->billID)->firstOrFail();
            $rs = Http::withHeader("Authorization","Bearer " . env("QIWI_SECRET_KEY"))
                ->get("https://api.qiwi.com/partner/bill/v1/bills/". $c_f->id);
            DB::transaction(function () use($rs,$c_f){
                if($rs['status']['value'] == "PAID") {
                    $c = $c_f->company;
                    $c->step_coins = $c->stepcoins + ($c_f['amount'] * 10);
                    $c->save();
                    $c_f->status = "completed";
                } else if($rs['status']['value'] != "WAITING") {
                    $c_f->status = "declined";
                }
                $c_f->save();
            });
            return true;
        } catch(Throwable $e) {
            dd($e);
        }
    }
}
