<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Nilai extends Resource
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
            'id' => $this->nilai_id,
            'nisn' => $this->murid->nisn,
            'murid' => $this->murid->nama,
            'guru' => $this->guru->nama,
            'mapel' => $this->mapel->nama,
            'jenis' => $this->jenis,
            'tahun_ajaran' => $this->tapel->tahun_ajaran,
            'nilai' => $this->nilai,
            'ip' => $this->nilai > 85 ? 4.00 : ($this->nilai > 80 ? 3.70 : ($this->nilai > 75 ? 3.30 : ($this->nilai >
             70 ? 3.00 : ($this->nilai > 65 ? 2.70 : ($this->nilai > 60 ? 2.30 : ( $this->nilai > 55 ? 2.00 :
             ($this->nilai > 50 ? 1.70 : ($this->nilai > 40 ? 1.00 : 0)))))))),
            'predikat' => $this->nilai > 85 ? 'A' : ($this->nilai > 80 ? 'A-' : ($this->nilai > 75 ? 'B+' : ($this->nilai > 70 ? 'B' : ($this->nilai > 65 ? 'B-' : ($this->nilai > 60 ? 'C+' : ($this->nilai > 55 ? 'C' : ($this->nilai > 50 ? 'C-' : ($this->nilai > 40 ? 'D' : 'E')))))))),
        ];
    }
}
