<?php

namespace App\Http\Controllers;

use App\Http\Resources\KabupatenCollection;
use App\Http\Resources\KecamatanCollection;
use App\Http\Resources\KelurahanCollection;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class Wilayah extends Controller
{
    public function provinsi(Request $request)
    {
            return [
                'kode' => 200,
                'message' => 'berhasil',
                'data' => Provinsi::where('nama', 'like', '%' . $request->nama . '%')->get()
            ];
    }
    public function kabupaten(Request $request)
    {
        if ($request->provinsi_id == null) {
            return new KabupatenCollection(Kabupaten::
            where('nama', 'like', '%' . $request->nama . '%')
            ->get());
        }
        return new KabupatenCollection(Kabupaten::
        where('provinsi_id', $request->provinsi_id)
        ->where('nama', 'like', '%' . $request->nama . '%')->get());
    }
    public function kecamatan(Request $request)
    {
        if ($request->kabupaten_id == null) {
            return new KecamatanCollection(Kecamatan::where('nama', 'like', '%' . $request->nama . '%')
                ->get());
        }
        return new KecamatanCollection(Kecamatan::
        where('kabupaten_id', $request->kabupaten_id)
        ->where('nama', 'like', '%' . $request->nama . '%')->get());
    }
    public function kelurahan(Request $request)
    {
        if ($request->kecamatan_id == null) {
            return new KelurahanCollection(Kelurahan::where('nama', 'like', '%' . $request->nama . '%')
                ->get());
        }
        return new KelurahanCollection(Kelurahan::
        where('kecamatan_id', $request->kecamatan_id)
        ->where('nama', 'like', '%' . $request->nama . '%')->get());
    }
}
