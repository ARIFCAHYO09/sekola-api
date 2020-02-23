<?php

namespace App\Http\Controllers;

use App\Http\Resources\PresensiCollection;
use App\Models\PointAksi;
use App\Models\PointTransaksi;
use App\Models\Presensi as ModelsPresensi;
use App\Models\Tapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Presensi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new PresensiCollection(ModelsPresensi::leftJoin('murid', 'presensi.murid_id', '=', 'murid.id')
            ->leftJoin('rombel', 'murid.rombel_id', '=', 'rombel.id')
            ->where('murid.rombel_id', $request->rombel_id)
            ->where('presensi.mapel_id', $request->mapel_id)
            ->where('presensi.tahun_ajaran_id', $request->tapel)
            ->where('presensi.created_at', 'like', '%' . $request->tanggal . '%')
            ->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $pointAksi = PointAksi::where('sekolah_id', Auth::guard('api')->user()->sekolah_id)
            ->where('nama', 'presensi')->first();
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
            $presensi[$i] = new ModelsPresensi();
            $presensi[$i]->tahun_ajaran_id = Tapel::where('status', 1)->first()->id;
            $presensi[$i]->user_id = Auth::guard('api')->user()->id;
            $presensi[$i]->murid_id = $request->murid_id[$i];
            $presensi[$i]->mapel_id = $request->mapel_id[$i];
            $presensi[$i]->status = $request->status[$i];
            $presensi[$i]->save();
        }
        return ['data' => $presensi, 'message' => 'presensi berhasil', 'kode' => 200];
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
            $presensi[$i] = ModelsPresensi::findorFail($request->id[$i]);
            $presensi[$i]->tahun_ajaran_id = Tapel::where('status', 1)->first()->id;
            $presensi[$i]->user_id = Auth::guard('api')->user()->id;
            $presensi[$i]->murid_id = $request->murid_id[$i];
            $presensi[$i]->mapel_id = $request->mapel_id[$i];
            $presensi[$i]->status = $request->status[$i];
            $presensi[$i]->save();
        }
        return new PresensiCollection(collect($presensi));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $presensi = ModelsPresensi::find($id);
        $presensi->delete();
        return ['message' => 'presensi dihapus', 'kode' => 200];
    }
}
