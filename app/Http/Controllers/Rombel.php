<?php

namespace App\Http\Controllers;

use App\Http\Resources\MuridOrtu;
use App\Http\Resources\RombelCollection;
use App\Models\Rombel as ModelsRombel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MuridOrtuCollection;

class Rombel extends Controller
{
    public function index()
    {
        return [
        'kode' => 200,
        'message' => 'berhasil',
        'data' =>  ModelsRombel::distinct('kelas')->select('kelas')
        ->where('sekolah_id', Auth::guard('api')->user()->sekolah_id)
        ->orderBy('id', 'desc')->get()];
    }
    public function indexOrtu(Request $request)
    {
        return [
            'kode' => 200,
            'message' => 'sukses',
            'data' => ModelsRombel::distinct('kelas')->select('kelas')
            ->where('sekolah_id', $request->sekolah_id)
            ->orderBy('id', 'desc')->get()
        ];
    }
    public function rombel($kelas)
    {
        return new RombelCollection(ModelsRombel::
        where('sekolah_id', Auth::guard('api')->user()->sekolah_id)->orderBy('id', 'desc')
        ->where('kelas', $kelas)->get());
    }
    public function rombelOrtu(Request $request)
    {
        return new RombelCollection(ModelsRombel::where('sekolah_id', $request->sekolah_id)->orderBy('id', 'desc')
            ->where('kelas', $request->kelas)->get());
    }
    public function murid($id)
    {
        $rombel = ModelsRombel::find($id);
        return new MuridOrtuCollection($rombel->murid);
    }
    public function muridOrtu(Request $request)
    {
        $rombel = ModelsRombel::find($request->rombel_id);
        return new MuridOrtuCollection($rombel->murid);
    }
    public function guru()
    {
        $arr = json_decode(Auth::guard('api')->user()->rombel_id);
        $array = [];
        if ($arr != null) {
            foreach ($arr as $a) {
                array_push($array, ModelsRombel::find($a));
            }
        }
        return ['data' => $array, 'message' => 'data berhasil diambil', 'kode' => 200];
    }
}
