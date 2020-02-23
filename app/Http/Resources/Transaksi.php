<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Transaksi extends Resource
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
            'aksi' => $this->pointAksi->nama,
            'rombel' => $this->rombel_id == null ? "tidak ada" : $this->rombel->kelas . ' ' . $this->rombel->rombel,
            'point' => $this->point,
            'status' => $this->status,
        ];
    }
}
