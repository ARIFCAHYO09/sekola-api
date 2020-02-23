<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SoalData extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'no_soal' => $this->no_soal,
            'nama' => $this->nama,
            'pilihan_A' => $this->pilihan_A,
            'pilihan_B' => $this->pilihan_B,
            'pilihan_C' => $this->pilihan_C,
            'pilihan_D' => $this->pilihan_D,
            'jawaban' => $this->jawaban,
            'penjelasan' => $this->penjelasan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}