<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Galeri extends Resource
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
            'guru' => $this->guru->nama,
            'rombel' => $this->rombel->kelas . ' ' . $this->rombel->rombel,
            'gambar' => $this->gambar,
            'keterangan' => $this->keterangan,
            'kategori' => $this->kategori->nama,
            'created_at' => $this->created_at
        ];
    }
}
