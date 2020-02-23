<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Murid;
use Illuminate\Support\Facades\Auth;

class Anak
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
        if (Murid::find($request->id)->rombel->sekolah->status_aktif == 0) {
            return [
                'kode' => '401',
                'message' => 'maaf status sekolah anda tidak aktif silahkan hubungi pihak sekolah'
            ];
        }

        if (Murid::find($request->id)->ortu_id != Auth::guard('ortus')->user()->id) {
            return [
                'kode' => '401',
                'message' => 'tambahkan dulu anak anda'
            ];
        }

        $response = $next($request);

        // Post-Middleware Action

        return $response;
    }
}
