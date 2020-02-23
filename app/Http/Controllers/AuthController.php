<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Ortu;
use Illuminate\Http\Request;
use App\Models\User;
use Psr\Http\Message\ServerRequestInterface;
use Laravel\Passport\Http\Controllers\AccessTokenController;

class AuthController extends AccessTokenController
{
    public function authGuru(ServerRequestInterface $request)
    {
        $status = User::where('email', $request->getParsedBody()['username'])->first();
        if ($status == null) {
            return ['message' => 'akun anda belum terdaftar silahkan login dahulu', 'kode' => 404];
        }
        if ($status->status == 1) {
            $tokenResponse = parent::issueToken($request);
            $token = $tokenResponse->getContent();

            // $tokenInfo will contain the usual Laravel Passort token response.
            $tokenInfo = json_decode($token, true);

            // Then we just add the user to the response before returning it.

            $tokenInfo = collect($tokenInfo);

            return ['message' => 'berhasil login', 'kode' => 200, 'data' => $tokenInfo];
        } else {
            return ['message' => 'maaf akun anda belum diaktifkan', 'kode' => 403];
        }
    }
    public function authOrtu(ServerRequestInterface $request)
    {
        $status = Ortu::where('email', $request->getParsedBody()['username'])->first();
        if ($status == null) {
            return ['message' => 'akun anda belum terdaftar silahkan registrasi dahulu', 'kode' => 404];
        } else {
            $tokenResponse = parent::issueToken($request);
            $token = $tokenResponse->getContent();
            // $tokenInfo will contain the usual Laravel Passort token response.
            $tokenInfo = json_decode($token, true);

            // Then we just add the user to the response before returning it.

            $tokenInfo = collect($tokenInfo);

            return ['message' => 'berhasil login', 'kode' => 200, 'data' => $tokenInfo];
        }
    }
}
