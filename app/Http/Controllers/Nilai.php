<?php

namespace App\Http\Controllers;

use App\Http\Resources\NilaiCollection;
use App\Models\Nilai as ModelsNilai;
use App\Models\Tapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PointAksi;
use App\Models\PointTransaksi;

class Nilai extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new NilaiCollection(Modelsnilai::leftJoin('murid', 'nilai.murid_id', '=', 'murid.id')
            ->leftJoin('rombel', 'murid.rombel_id', '=', 'rombel.id')
            ->where(function ($query) use ($request) {
                if ($request->tugas_id != null) {
                    $query->where('tugas_id', $request->tugas_id);
                } else {
                    $query->wherenull('tugas_id');
                }
            })
            ->where('nilai.jenis', 'like', '%' . $request->jenis . '%')
            ->where('murid.rombel_id', $request->rombel_id)
            ->where('nilai.mapel_id', $request->mapel_id)
            ->where('nilai.tahun_ajaran_id', $request->tapel)
            ->where('nilai.created_at', 'like', '%' . $request->tanggal . '%')
            ->select('*', 'nilai.id as nilai_id')
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
            ->where('nama', 'nilai');
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
            $nilai[$i] = new ModelsNilai();
            $nilai[$i]->user_id = Auth::guard('api')->user()->id;
            $nilai[$i]->tahun_ajaran_id = Tapel::where('status', 1)->first()->id;
            $nilai[$i]->murid_id = ($request->murid_id[$i]);
            $nilai[$i]->mapel_id = ($request->mapel_id[$i]);
            $nilai[$i]->jenis = ($request->jenis[$i]);
            $nilai[$i]->nilai = ($request->nilai[$i]);
            $nilai[$i]->tugas_id = ($request->tugas_id[$i]);
            $nilai[$i]->save();
        }
        return [
            "message" => "data berhasil disimpan",
            "kode" => 200
        ];
        // return new NilaiCollection(collect($nilai));
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
            $nilai[$i] = ModelsNilai::findorFail($request->id[$i]);
            $nilai[$i]->user_id = Auth::guard('api')->user()->id;
            $nilai[$i]->tahun_ajaran_id = Tapel::where('status', 1)->first()->id;
            $nilai[$i]->murid_id = ($request->murid_id[$i]);
            $nilai[$i]->mapel_id = ($request->mapel_id[$i]);
            $nilai[$i]->jenis = ($request->jenis[$i]);
            $nilai[$i]->nilai = ($request->nilai[$i]);
            $nilai[$i]->save();
        }
        return [
            "message" => "data berhasil disimpan",
            "kode" => 200
        ];
        // return new NilaiCollection(collect($nilai));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilai = ModelsNilai::find($id);
        $nilai->delete();
        return [
            'kode' => 200,
            'message' => 'nilai berhasil dihapus'
        ];
    }
}
