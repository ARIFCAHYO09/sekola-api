<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\Models\Murid;

class PembayaranOrtu
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
        if (Auth::guard('ortus')->user()->status_pembayaran == 0) {
            return [
                'kode' => '401',
                'message' => 'lunasi tagihan anda terlebih dahulu untuk menggunakan aplikasi'
            ];
        }
        $response = $next($request);

        // Post-Middleware Action

        return $response;
    }
}
