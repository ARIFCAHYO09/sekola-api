<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Jadwal extends Resource
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
            'mapel' => $this->mapel->nama,
            'rombel' => $this->rombel->kelas . ' '. $this->rombel->rombel,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'user' => $this->guru->nama,
            'hari' => $this->hari,
            'ruang' => $this->ruang->nama,
        ];
    }
}
