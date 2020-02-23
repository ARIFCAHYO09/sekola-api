<?php

namespace App\Http\Controllers;

use App\Http\Resources\MapelbyGuruCollection;
use App\Models\Mapel as ModelsMapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Mapel extends Controller
{
    public function index()
    {
        return [
            'kode' => 200,
            'message' => 'berhasil',
            'data' => ModelsMapel::where('sekolah_id', Auth::guard('api')->user()->sekolah_id)->get()
        ];
    }
    public function guru()
    {
        $arr = json_decode(Auth::guard('api')->user()->mapel_id);
        $array = [];
        if ($arr != null) {
            foreach ($arr as $a) {
                array_push($array, ModelsMapel::find($a));
            }
        }
        return ['data' => $array, 'message' => 'data berhasil diambil', 'kode' => 200];
    }
}
