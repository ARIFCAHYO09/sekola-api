<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Soal extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (($request->has('mapel') && $request->mapel != '') && ($request->has('class') && $request->class != '')) {
            $dataSoal = [
                'data_soal_detail_url' => url('/api/bank/soal/data/?soal_id=' . $this->id),
            ];
        } else {
            $dataSoal = [];
        }

        $dataMain = [
            'id' => $this->id,
            'nama' => $this->nama,
            'jumlah_soal' => $this->jumlah_soal,
            'skor' => $this->skoring,
            'level' => $this->level,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        return array_merge($dataMain, $dataSoal);

    }
}