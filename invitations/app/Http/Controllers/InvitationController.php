<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvitationController extends Controller
{
    public function invitation(InvitationRequest $request)
    {
        $h = $request->hash;
        $invite = DB::table('company_invites')->where('hash', $h)->first();
        $company = DB::table('companies')->where("id", $invite->company_id)->first();
        return view('welcome', [
            "name" => $company->name,
            "company_id" => $company->id
        ]);
    }
}
