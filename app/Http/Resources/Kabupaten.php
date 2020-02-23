<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Kabupaten extends Resource
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
            'nama'=> $this->nama,
            'kode' => $this->kode,
            'provinsi' => $this->provinsi->nama
        ];
    }
}
