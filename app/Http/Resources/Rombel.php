<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Rombel extends Resource
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
            'kelas' => $this->kelas,
            'rombel' => $this->rombel,
            'keterangan' => $this->keterangan,
            'sekolah' => $this->sekolah->nama,
        ];
    }
}
