<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Sekolah extends Resource
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
            'npsn' => $this->npsn,
            'alamat' => $this->alamat,
            'kode_pos' => $this->kode_pos,
            'kelurahan' => $this->kelurahan->nama,
            'jenjang_pendidikan' => $this->jenjang->nama,
            'status_sekolah' => $this->status_sekolah,
            'point' => $this->point,
            'email' => $this->email,
            'website' => $this->website,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
