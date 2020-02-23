<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Ortu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Pre-Middleware Action

        if (Auth::guard('ortus')->user()->status == 0) {
            return [
                'kode' => '401',
                'message' => 'maaf akun anda telah diblokir'
            ];
        }
        $response = $next($request);

        // Post-Middleware Action

        return $response;
    }
}
