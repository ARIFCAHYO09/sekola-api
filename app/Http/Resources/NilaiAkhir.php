<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class NilaiAkhir extends Resource
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
            'mapel_id' => $this->mapel_id,
            'nilai' => $this->nilai,
            'ip' => $this->nilai > 85 ? 4.00 : ($this->nilai > 80 ? 3.70 : ($this->nilai > 75 ? 3.30 : ($this->nilai > 70 ? 3.00 : ($this->nilai > 65 ? 2.70 : ($this->nilai > 60 ? 2.30 : ($this->nilai > 55 ? 2.00 : ($this->nilai > 50 ? 1.70 : ($this > 40 ? 1.00 : 0)))))))),
            'predikat' => $this->nilai > 85 ? 'A' : ($this->nilai > 80 ? 'A-' : ($this->nilai > 75 ? 'B+' : ($this->nilai > 70 ? 'B' : ($this->nilai > 65 ? 'B-' : ($this->nilai > 60 ? 'C+' : ($this->nilai > 55 ? 'C' : ($this->nilai > 50 ? 'C-' : ($this > 40 ? 'D' : 'E')))))))),
            'kkm' => $this->mapel->kkm,
            'status' => $this->nilai >= $this->mapel->kkm ? 'lulus' : 'tidak lulus'
        ];
        return parent::toArray($request);
    }
}
