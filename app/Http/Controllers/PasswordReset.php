<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ortu;
use App\Models\ResetPass;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Str;

class PasswordReset extends Controller
{

    // public function __construct()
    // {
    // }
    public function email($broker, Request $request)
    {
        if ($broker == "guru") {
            $user = User::where("email", $request->email)->first();
            $model = 'App\Models\User';
            if ($user == null) {
                return ["message" => "user tidak ditemukan", "kode" => 200];
            }
        } elseif ($broker == "ortus") {
            $user = Ortu::where("email", $request->email)->first();
            echo $user;
            $model = 'App\Models\Ortu';
            if ($user == null) {
                return ["message" => "user tidak ditemukan", "kode" => 200];
            }
        }
        $otp = ResetPass::where('model', $model)->where('model_id', $user->id);
        $otp->delete();
        $reset = new ResetPass();
        $reset->token = Str::random(40);
        $reset->model = $model;
        $reset->model_id = $user->id;
        $reset->otp =  rand(00000000, 99999999);
        $reset->save();
        $user->notify(new ResetPasswordNotification([
            "otp" => $reset->otp,
        ]));
        return ["message" => "berhasil, silahkan cek email anda", "code" => 200, "token" => $reset->token];
    }
    public function res(Request $request) {
        $token = $request->token;
        $reset = ResetPass::where("token", $token)
        ->where('created_at', '>', 'DATE_SUB(NOW(), INTERVAL 1 HOUR)')
        ->first();
        if ($reset == null) {
            return ['message' => 'token tidak ditemukan atau sudah kadaluarsa', 'kode' => 404];
        }
        if ($reset->model == "App\Models\User") {
            $user = User::find($reset->id);
        } else {
            $user =  Ortu::find($reset->id);
        }
        if ($reset->otp == $request->otp) {
            $user->password = $request->password_confirmation;
            $user->save();
            return ["message" => "password berhasil disimpan", "kode" => 200];
        } else {
            return ["message" => "maaf kode otp salah,  password gagal disimpan", "kode" => 200];
        }
    }
}
