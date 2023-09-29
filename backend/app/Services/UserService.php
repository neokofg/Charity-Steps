<?php

namespace App\Services;

use App\Models\User;
use App\Models\UsersVerify;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class UserService {

    private function generateCode(): Int
    {
        $is_unique = false;
        while($is_unique == false){
            $code = rand(1000,9999);
            if(!UsersVerify::where('code',$code)->exists()){
                $is_unique = true;
            }
        }
        return $code;
    }
    public function register($r): Bool
    {
        try {
            //generating code
            $c = $this->generateCode();

            $e = $r['email'];

            DB::transaction(function () use($c, $e) {
                //creating User model
                $u = new User();
                $u->email = $e;
                $u->save();

                //creating Verify model
                $u_v = new UsersVerify();
                $u_v->code = $c;
                $u_v->user_id = $u->id;
                $u_v->save();

                //sending mail
                Mail::send('emails.email_verification', ['code' => $c], function($message) use($e){
                    $message->to($e);
                    $message->subject('CharitySteps');
                });
            });
            return true;
        } catch(Throwable $e) {
            return false;
        }

    }

    public function register_approve($r): mixed
    {
        try {
            $c = $r['code'];

            $token = DB::transaction(function () use($c) {
                $u_v = UsersVerify::where("code", '=', $c)->firstOrFail();

                $u = User::where("id", '=', $u_v->user_id)->firstOrFail();
                $u->is_email_verified = true;
                $u->save();

                $u_v->delete();

                return $u->createToken($u->id . "|token")->plainTextToken;
            });
            return $token;
        } catch (Throwable $e) {
            return false;
        }
    }

    public function register_update($r, $u): Bool
    {
        try {
            $u->name = $r['name'];
            $u->surname = $r['surname'];
            $u->sex = $r['sex'];
            $u->save();
            return true;
        } catch (Throwable $e) {
            return false;
        }
    }
}
