<?php

namespace App\Http\Controllers;

use App\Http\Resources\JadwalCollection;
use App\Http\Resources\JadwalEkstraCollection;
use App\Models\User;
use App\Models\JadwalEkstra;
use App\Models\Tapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Jadwal extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
    public function japel()
    {
        $user = Auth::user();
         return new JadwalCollection($user->japel);
    }
    public function jadwalEkstra()
    {
        $user = Auth::guard('api')->user();
        $tahun = Tapel::where('status', 1)->first();
        $id_sekolah = Auth::guard('api')->user()->sekolah_id;
        // return JadwalEkstra::whereJsonContains('guru_id', $user->id)->paginate(5);
        return new JadwalEkstraCollection(JadwalEkstra::whereJsonContains('guru_id', $user->id)->
        where('tahun_ajaran_id', $tahun->id)->paginate(5));
        //dibawah tidak dipakai
        $newestTahunAjaran = JadwalEkstra::max('tahun_ajaran_id');
        $getJadwalEkskul = JadwalEkstra::where('tahun_ajaran_id', $newestTahunAjaran)
            ->where('sekolah_id', $id_sekolah)
            ->get();

        $idJadwalIn = array();
        foreach ($getJadwalEkskul as $jadwalEkskul) {
            if (in_array(Auth::id(), json_decode($jadwalEkskul->guru_id))) {
                array_push($idJadwalIn, $jadwalEkskul->id);
            }
        }

        $jadwalEkskulIn = JadwalEkstra::leftJoin('ekskul', 'jadwal_ekskul.ekskul_id', 'ekskul.id')
            ->leftJoin('tahun_ajaran', 'jadwal_ekskul.tahun_ajaran_id', 'tahun_ajaran.id')
            ->whereIn('jadwal_ekskul.id', $idJadwalIn)
            ->select('jadwal_ekskul.id', 'ekskul.nama as ekskul_nama', 'ekskul.keterangan as ekskul_keterangan', 'tahun_ajaran.tahun_ajaran', 'jadwal_ekskul.jam_mulai', 'jadwal_ekskul.jam_selesai', 'jadwal_ekskul.hari', 'jadwal_ekskul.tempat')
            ->get();

        return [
            'data' => $jadwalEkskulIn,
            'kode' => 200,
            'message' => 'data berhasil diambil'
        ];
    }
}
