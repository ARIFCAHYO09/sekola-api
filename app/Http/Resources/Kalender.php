<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Kalender extends Resource
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
            'jenis' => $this->jenis == 1 ? "Akademik" : ($this-> jenis == 2 ? "Acara Tahunan" : ($this->jenis == 3 ? "Gathering" : "Ujian")),
            'tanggal_mulai' => date("d F Y",  strtotime(str_replace('-"', '/', $this->tanggal_mulai))),
            'tanggal_selesai' => date("d F Y",  strtotime(str_replace('-"', '/', $this->tanggal_selesai))),
            'sekolah' => $this->sekolah->nama,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
