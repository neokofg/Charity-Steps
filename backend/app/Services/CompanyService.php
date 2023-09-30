<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CompanyInvites;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Throwable;

class CompanyService {
    public function create_link($r, $u): mixed
    {
        if(!$u->isCompanyUser($r['company_id'])){
            return false;
        }
        try {
            $c = Company::findOrFail($r['company_id']);
            $h = Crypt::encryptString($c->id . " " . Carbon::now()->format("Y-m-d"));
            $c_i = new CompanyInvites();
            $c_i->hash = $h;
            $c_i->company_id = $c->id;
            $c_i->save();
            return "https://inv.charity-steps.ru?hash=". $h;
        } catch (Throwable $e) {
            return false;
        }


    }
}
