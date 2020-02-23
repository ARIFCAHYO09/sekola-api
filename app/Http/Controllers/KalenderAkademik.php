<?php

namespace App\Http\Controllers;

use App\Http\Resources\KalenderCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KalenderAkademik as ModelsKalender;

class KalenderAkademik extends Controller
{
    //
    public function index(Request $request)
    {
        $user = Auth::guard('api')->user();
        return [
            'message' => 'sukses',
            'kode' => '200',
            'data' => new KalenderCollection(ModelsKalender::where('tanggal_mulai', 'like', '%' . $request->tahun . '%')
                ->where('tanggal_mulai', 'like', '%' . $request->tahun . '%')
                ->where('sekolah_id', $user->sekolah_id)
                ->get())
        ];
    }
}
