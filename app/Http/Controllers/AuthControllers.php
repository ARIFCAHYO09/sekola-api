<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\KodeOTP;
use App\Models\Ortu;
use App\Models\User;
use App\Notifications\Oauth;
use App\Notifications\OTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

session_start();

class AuthControllers extends Controller
{

    public function loginGuru(Request $request)
    {
        // $this->validate($request, [
        //     'email' => 'required',
        //     'password' => 'required'
        // ]);

        $credentials = $request->only(['email', 'password']);
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['message' => 'unauthorized'], 401);
        }
        $otp = KodeOTP::where('model', 'guru')->where('user_id', Auth::guard('api')->user()->id);
        $otp->delete();
        $otp = new KodeOTP();
        $otp->user_id = Auth::guard('api')->user()->id;
        $otp->model = 'guru';
        $otp->token = Str::random(40);
        // $otp->otp = rand(0000, 9999);
        $otp->otp = 1111;
        $otp->save();
        Auth::guard('api')->user()->notify(new OTP($otp->otp));
        Auth::guard('api')->logout();
        return ['message' => 'berhasil, silahkan cek email anda', 'kode' => 200, 'token' => $otp->token];
        //return $this->respondWithToken($token);
    }

    public function loginGuruOTP(Request $request)
    {
        $otp = KodeOTP::where('token', $request->token)
            ->where('created_at', '>', 'DATE_SUB(NOW(), INTERVAL 2 HOUR)')->first();
        if ($otp == null) {
            return ['message' => 'token tidak ditemukan atau sudah kadaluarsa', 'kode' => 404];
        }
        $user = User::find($otp->user_id);
        if ($request->otp == $otp->otp) {
            if (!$token = Auth::guard('api')->login($user)) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return $this->respondWithToken($token);
        } else {
            return ['message' => 'kode otp salah', 'kode' => 403];
        }
    }
    public function loginOrtuOTP(Request $request)
    {
        $otp = KodeOTP::where('token', $request->token)
            ->where('created_at', '>', 'DATE_SUB(NOW(), INTERVAL 2 HOUR)')->first();
        if ($otp == null) {
            return ['message' => 'token tidak ditemukan atau sudah kadaluarsa', 'kode' => 404];
        }
        $user = Ortu::find($otp->user_id);
        if ($request->otp == $otp->otp) {
            if (!$token = Auth::guard('api')->login($user)) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return $this->respondWithToken($token);
        } else {
            return ['message' => 'kode otp salah', 'kode' => 403];
        }
    }

    public function loginOrtu(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (!$token = Auth::guard('ortus')->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $otp = KodeOTP::where('model', 'ortus')->where('user_id', Auth::guard('ortus')->user()->id);
        $otp->delete();
        $otp = new KodeOTP();
        $otp->user_id = Auth::guard('ortus')->user()->id;
        $otp->model = 'ortus';
        $otp->token = Str::random(40);
        // $otp->otp = rand(0000, 9999);
        $otp->otp = 1111;
        $otp->save();
        Auth::guard('ortus')->user()->notify(new OTP($otp->otp));
        Auth::guard('ortus')->logout();
        return ['message' => 'berhasil, silahkan cek email anda', 'kode' => 200, 'token' => $otp->token];
        //return $this->respondWithToken($token);
    }

    public function logoutGuru()
    {
        Auth::guard('api')->logout();
        return ['kode' => 200, 'message' => 'berhasil logout'];
    }

    public function logoutOrtu()
    {
        Auth::guard('ortus')->logout();
        return ['kode' => 200, 'message' => 'berhasil logout'];
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'data' => [
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => 31540000,
            ],
            'message' => 'berhasil login',
            'kode' => 200,
        ], 200);
    }
    public function redirectToProvider($sosmed, $guard)
    {
        //$request->session()->put('pelindung', $guard);
        $_SESSION["pelindung"] = $guard;
        return Socialite::driver($sosmed)->stateless()->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */

    public function handleProviderCallback(Request $request, $sosmed)
    {
        $guard = $_SESSION["pelindung"];
        session_destroy();
        $guard == 'guru' ? $guard = 'api' : $guard;
        $githubUser = Socialite::driver($sosmed)->stateless()->user();
        //echo $request->session()->get('pelindung');
        //dd($githubUser);
        // $user->token;
        $guard == 'api' ? $user = User::where('email', $githubUser->getEmail())->first()
        : $user = Ortu::where('email', $githubUser->getEmail())->first();
        //mendapatkan id github
        //jika user tidak ditemukan maka akan meregistrasikan user baru
        if (!$user) {
            if ($guard == 'api') {
                return ['kode' => 404, 'message' => 'data tidak ditemukan'];
            }
            $intvar = $githubUser->getID();
            $random_password = Str::random(8);
            if ($githubUser->getName() == null) {
                $name = Str::random(8);
            } else {
                $name = $githubUser->getName();
            }
            $hashed_random_password = Hash::make($random_password);
            $guard == 'api' ? $user = new User() : $user = new Ortu();
            $user->email = $githubUser->getEmail();
            $user->nama = $name;
            $user->password = $hashed_random_password;
            $data = array(
                'view' => 'emails.github',
                'subject' => 'Laravel ' . $sosmed . ' Registration',
                'nama' => $name,
                'email' => $githubUser->getEmail(),
                'password' => $random_password,
                'sosmed' => $sosmed,
            );
            //Mail::to($user->email)->send(new SendMail($data));
            $user->save();
            $user->notify(new Oauth($data));
            //meregistrasikan user baru jika belum ada
        }
        //me loginkan user
        Auth::guard($guard)->login($user);
        return [
            'data' => Auth::guard($guard)->user(),
            'kode' => 200,
            'message' => 'berhasil login',
        ];
    }
}
