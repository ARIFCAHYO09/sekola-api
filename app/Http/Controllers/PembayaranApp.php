<?php

namespace App\Http\Controllers;

use App\Models\PembayaranApp as PembayaranAppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranApp extends Controller
{
    public function listPaymentMethod()
    {
        return [
            'data' => DB::table('metode_pembayaran')->get(),
            'kode' => 200,
            'message' => 'berhasil ambil data'
        ];
    }

    public function pembayaran(Request $request)
    {
        $data = new PembayaranAppModel();
        $data->fill($request->all());
        $data->ortu_id = Auth::id();
        $data->tanggal_aktivasi = date('Y-m-d');

        $baseNumber = '000000';
        $todayTransactionNumber = PembayaranAppModel::where('tanggal_aktivasi', date('Y-m-d'))->count() + 1;
        $currentTransactionNumber = substr($baseNumber, 0, strlen($baseNumber) - strlen($todayTransactionNumber)) . $todayTransactionNumber;

        $data->invoice = 'INV/' . date('Ymd') . '/' . $data->metode_pembayaran_id . '/' . $currentTransactionNumber;

        $data->save();

        return [
            'data' => $data,
            'kode' => 200,
            'message' => 'berhasil tambah data'
        ];
    }
}
