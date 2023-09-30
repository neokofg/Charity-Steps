<?php

namespace App\Services;

use App\Models\CompanyFills;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Qiwi\Api\BillPayments;
use Throwable;

class PaymentService {

    public function __construct(BillPayments $billPayments)
    {
    }
    public function wallet_fill($r, $u)
    {
        if(!$u->isCompanyUser($r['company_id'])){
            return false;
        }
        try {
            $b_p = new BillPayments(env("QIWI_SECRET_KEY"));
            $expDate = Carbon::now()->addMinutes(15)->toIso8601String();

            $url = DB::transaction(function () use($expDate,$r,$b_p,$u) {
                $c_f = new CompanyFills();
                $c_f->amount = $r['amount'];
                $c_f->expDate = $expDate;
                $c_f->company_id = $r['company_id'];
                $c_f->user_id = $u->id;
                $c_f->status = "pending";
                $c_f->save();
                $f = [
                    'amount' => $r['amount'],
                    'currency' => 'RUB',
                    'comment' => 'Перевод денег в stepcoin-ы, для приложения Charity Steps',
                    'expirationDateTime' => $expDate,
                    'email' => 'support@charity-steps.ru',
                    'account' => $u->id,
                    'successUrl' => 'https://api.charity-steps.ru/api/callback?billID='. $c_f->id
                ];
                $rsp = $b_p->createBill($c_f->id, $f);
                return $rsp['payUrl'];
            });
            return $url;
        } catch (Throwable $e) {
            return false;
        }
    }

}
