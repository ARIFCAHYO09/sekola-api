<?php

namespace App\Http\Controllers;

use App\Http\Resources\VoucherCollection;
use App\Models\PointTransaksi;
use App\Models\Voucher as ModelsVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserVoucher;

class Voucher extends Controller
{
    //
    public function index(Request $request)
    {
        $uni =  ModelsVoucher::where("sekolah_id", Auth::guard('api')->user()->sekolah_id);
        return new VoucherCollection(
            ModelsVoucher::rightJoin('merchant', 'voucher.merchant_id', '=', 'merchant.id')->orwhere(
                'merchant.sekolah_id',
                Auth::guard('api')->user()->sekolah_id
            )
            ->where('voucher.nama', 'like', '%' . $request->nama . '%')->select("voucher.*")->union($uni)
                ->get()
        );
    }
    public function redeem(Request $request)
    {
        $user = User::find(Auth::guard('api')->user()->id);
        $hrg = ModelsVoucher::find($request->voucher_id)->first()->point;
        if ($user->point >= $hrg) {
            $redeem = new UserVoucher();
            $redeem->user_id = Auth::guard('api')->user()->id;
            $redeem->voucher_id = $request->voucher_id;
            $redeem->status = 1;
            $redeem->save();
            $user->point -= $hrg;
            $user->save();
            $trk = new PointTransaksi();
            $trk->user_id = Auth::guard('api')->user()->id;
            $trk->point = $hrg;
            $trk->status = 1;
            $trk->rombel_id = null;
            $trk->save();
            return ['message' => 'voucher berhasil didapatkan', 'kode' => 200];
        } else {
            return ["message" => "maaf saldo anda tidak cukup", 'kode' => 200];
        }
    }
}
