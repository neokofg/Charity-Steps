<?php

namespace App\Services;

use App\Models\User;
use App\Models\UsersVerify;
use App\Models\UsersVerifyUpdateEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        if(!is_null($u->password)){
            return false;
        }
        try {
            $u->name = $r['name'];
            $u->surname = $r['surname'];
            $u->sex = $r['sex'];
            $u->password = Hash::make($r['password']);
            $u->save();
            return true;
        } catch (Throwable $e) {
            return false;
        }
    }

    public function login($r): mixed
    {
        try {
            if(Auth::attempt($r)) {
                $u = Auth::user();
                $t = $u->createToken($u->id . "|token")->plainTextToken;
                return $t;
            } else {
                return false;
            }
        } catch (Throwable $e) {
            return false;
        }
    }

    public function user_update($r, $u): Bool
    {
        try {
            $u->update($r);
            return true;
        } catch (Throwable $e) {
            return false;
        }
    }

    public function user_update_email($r, $u)
    {
        try {
            //generating code
            $c = $this->generateCode();

            $e = $r['email'];

            DB::transaction(function () use($c, $e, $u) {
                //creating Verify model
                $u_v = UsersVerifyUpdateEmail::firstOrNew(['user_id' => $u->id]);
                $u_v->email = $e;
                $u_v->code = $c;
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

    public function user_update_email_approve($r, $u): Bool
    {
        try {
            $c = $r['code'];

            DB::transaction(function () use($c, $u) {
                $u_v = UsersVerifyUpdateEmail::where("code", '=', $c)
                    ->where("user_id", '=', $u->id)
                    ->firstOrFail();

                $u->email = $u_v->email;
                $u->save();

                $u_v->delete();
            });
            return true;
        } catch (Throwable $e) {
            return false;
        }
    }
}
