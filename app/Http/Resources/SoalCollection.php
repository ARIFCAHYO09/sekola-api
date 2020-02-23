<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class SoalCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($request->has('class') && $request->class != '') {
            $kelas = DB::table('kelas_edukasi')
                ->leftJoin('edukasi', 'edukasi.id', '=', 'kelas_edukasi.edukasi_id')
                ->select(DB::raw('CONCAT(kelas_edukasi.nama, " ", edukasi.nama) as nama_kelas'))
                ->where('kelas_edukasi.id', $request->class)->first();

            $dataKelas = [
                'data_class' => $kelas->nama_kelas,
            ];
        } else {
            $dataKelas = [];
        }

        $dataMain = [
            'code' => 200,
            'message' => 'Berhasil ambil data',
            'data' => $this->collection,
        ];

        return array_merge($dataMain, $dataKelas);

    }
}
