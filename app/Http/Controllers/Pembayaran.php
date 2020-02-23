<?php

namespace App\Http\Controllers;

use App\Http\Resources\PembayaranCollection;
use App\Http\Resources\PembayaranMuridCollection;
use App\Models\Murid;
use App\Models\Pembayaran as ModelsPembayaran;
use App\Models\PembayaranSiswa as ModelsPembayaranSiswa;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PointAksi;
use App\Models\PointTransaksi;
use Illuminate\Support\Facades\Auth;
use App\Models\Rombel;
use Illuminate\Support\Facades\DB;

class Pembayaran extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return [
            'message' => 'berhasil',
            'kode' => 200,
            'data' => ModelsPembayaran::where('nama', 'like', '%' . $request->nama .
                '%')
                ->where('sekolah_id', Auth::guard('api')->user()->sekolah_id)
                ->orderBy('id', 'desc')->paginate(5)
                ->appends($request->query())
        ];
    }

    public function indexRombelOld(Request $request, $id)
    {
        $rombel = Rombel::find($id);
        $bayarnull = ModelsPembayaran::wherenull('rombel_id')
            ->where('sekolah_id', Auth::guard('api')->user()->sekolah_id);
        return new PembayaranCollection($rombel->pembayaran()->orderBy('id', 'desc')
            ->union($bayarnull)
            ->where('nama', 'like', '%' . $request->nama . '%')
            ->paginate(5)->appends($request->query()));
    }



    public function indexRombel(Request $request, $id)
    {
        $id_sekolah = Rombel::find($id)->sekolah_id;

        $specificPaymentList = ModelsPembayaran::where('rombel_id', $id)->get();
        foreach ($specificPaymentList as $specificPayment) {
            $specificPaymentId[$specificPayment->id] = $specificPayment->spesifik_dari;
        }

        $globalPaymentList = ModelsPembayaran::where('sekolah_id', $id_sekolah)
            ->whereNull('rombel_id')
            ->get();
        $paymentId = array();
        foreach ($globalPaymentList as $globalPayment) {
            if (in_array($globalPayment->id, $specificPaymentId)) {
                array_push($paymentId, array_search($globalPayment->id, $specificPaymentId));
            } else {
                array_push($paymentId, $globalPayment->id);
            }
        }

        $data = ModelsPembayaran::whereIn('pembayaran.id', $paymentId);

        return new PembayaranCollection($data->where('nama', 'like', '%' . $request->nama . '%')
            ->paginate(5)->appends($request->query()));
    }


    public function indexRombelMurid(Request $request, $id)
    {
        $rombel = Rombel::find($id);
        $muridnull = Murid::select('*', 'nama as nama_murid', DB::raw('(select pembayaran from pembayaran_siswa where pembayaran_siswa.murid_id = murid.id and bayar_id=' . $request->bayar_id . ') as pembayaran,
        (select bayar_id from pembayaran_siswa where pembayaran_siswa.murid_id = murid.id and bayar_id=' . $request->bayar_id . ') as bayar_id,
        (select murid_id from pembayaran_siswa where pembayaran_siswa.murid_id = murid.id and bayar_id=' . $request->bayar_id . ') as murid_id,
        (select id from pembayaran_siswa where pembayaran_siswa.murid_id = murid.id and bayar_id=' . $request->bayar_id . ') as pembayaran_siswa_id,
        (select biaya from pembayaran where pembayaran.id=' . $request->bayar_id . ') as biaya,
        (select keterangan from pembayaran where pembayaran.id=' . $request->bayar_id . ') as keterangan,
        (select nama from pembayaran where pembayaran.id=' . $request->bayar_id . ') as nama_pembayaran '))->where('rombel_id', $id);
        return new PembayaranMuridCollection($muridnull->get());
    }



    // public function indexRombelMurid(Request $request, $id)
    // {
    //     $murid = Murid::leftJoin('pembayaran_siswa', 'murid.id', 'pembayaran_siswa.murid_id')
    //         ->where('murid.rombel_id', $id)
    //         ->select('pembayaran_siswa.id', 'murid.nama', 'pembayaran_siswa.pembayaran', 'murid.nisn', 'murid.id')
    //         ->get();


    //     dd($murid);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pointAksi = PointAksi::where('sekolah_id', Auth::guard('api')->user()->sekolah_id)
            ->where('nama', 'pembayaran')->first();
        if ($pointAksi != null) {
            $trk = new PointTransaksi();
            $trk->user_id = Auth::guard('api')->user()->id;
            $trk->point_aksi_id = $pointAksi->first()->id;
            $trk->status = 0;
            $trk->point = $pointAksi->first()->point;
            $trk->rombel_id = $request->rombel_id;
            $trk->save();
            $user = User::find(Auth::guard('api')->user()->id);
            $user->point += $trk->point;
            $user->save();
        }
        for ($i = 0; $i < count($request->murid_id); $i++) {
            $bayar[$i] = new ModelsPembayaranSiswa();
            $bayar[$i]->murid_id = ($request->murid_id[$i]);
            $bayar[$i]->bayar_id = ($request->bayar_id[$i]);
            $bayar[$i]->user_id = Auth::guard('api')->user()->id;
            $bayar[$i]->pembayaran = $request->pembayaran[$i];
            $bayar[$i]->save();
        }
        return ["message" => "data berhasil disimpan", "code" => 200];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        for ($i = 0; $i < count($request->murid_id); $i++) {
            $bayar[$i] = ModelsPembayaranSiswa::where("bayar_id", $request->bayar_id[$i])
                ->where("murid_id", $request->bayar_id[$i]);
            $bayar[$i]->user_id = Auth::guard('api')->user()->id;
            $bayar[$i]->pembayaran = ($request->pembayaran[$i]);
            $kos = $bayar[$i]->first();
            if ($kos) {
                $bayar[$i]->save();
            } else {
                return ["message" => "data tidak ditemukan", "kode" => 200];
            }
        }
        return ["message" => "berhasil", "kode" => 200];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
