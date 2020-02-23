<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Sekolah
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

        if (Auth::guard('api')->user()->sekolah->status_aktif == 0) {
            return [
                'kode' => '401',
                'message' => 'maaf status sekolah anda tidak aktif silahkan hubungi pihak sekolah'
            ];
        }
        $response = $next($request);

        // Post-Middleware Action

        return $response;
    }
}
