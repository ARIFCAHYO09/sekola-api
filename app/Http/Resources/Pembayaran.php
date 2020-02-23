<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Pembayaran extends Resource
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
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
            'rombel' => $this->rombel_id == null ?
            'semua kelas' : $this->rombel->kelas . ' ' . $this->rombel->rombel,
            'biaya' => $this->biaya,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
