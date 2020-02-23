<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Presensi extends Resource
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
            'murid' => $this->murid->nama,
            'guru' => $this->guru->nama,
            'mapel' => $this->mapel->nama,
            'jam' => ($this->created_at) ? date_format($this->created_at, 'Y-m-d H:m:s') : null,
            'tahun_ajaran' => $this->tapel->tahun_ajaran,
            'status' => $this->status == 0 ? 'tanpa keterangan' :
            ( $this->status == 1 ? 'masuk' : ( $this->status == 2 ?
            'izin' : 'sakit' ) ),
            'created_at' => ($this->created_at) ? date_format($this->created_at, 'Y-m-d H:m:s') : null
        ];
    }
}
