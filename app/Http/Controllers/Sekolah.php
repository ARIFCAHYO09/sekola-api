<?php

namespace App\Http\Controllers;

use App\Http\Resources\SekolahCollection;
use App\Models\Kelurahan;
use App\Models\Sekolah as ModelsSekolah;
use Illuminate\Http\Request;

class Sekolah extends Controller
{
    public function index(Request $request)
    {
        return new SekolahCollection(ModelsSekolah::where('nama', 'like', '%' . $request->nama . '%')->get());
    }
    public function indexKelurahan($id)
    {
        $kelurahan = Kelurahan::find($id)->sekolah;
        return $kelurahan;
    }
}
