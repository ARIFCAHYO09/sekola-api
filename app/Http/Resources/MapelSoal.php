<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MapelSoal extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (($request->has('edu') && $request->edu != '') && ($request->has('class') && $request->class != '')) {
            $dataKelas = [
                'data_soal_url' => url('/api/bank/soal?mapel=' . $this->id . '&class=' . $request->class),
            ];
        } else {
            $dataKelas = [];
        }

        $dataMain = [
            'id' => $this->id,
            'icon' => url('storage/bank/soal/mapel/' . $this->icon),
            'nama' => $this->nama,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        return array_merge($dataMain, $dataKelas);
    }
}