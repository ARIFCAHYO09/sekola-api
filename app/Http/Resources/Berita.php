<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Berita extends Resource
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
            'judul' => $this->judul,
            'konten' => $this->konten,
            'gambar' => $this->gambar,
            'status' => $this->status,
            'user' => $this->guru->nama,
            'sekolah' => $this->sekolah->nama,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
