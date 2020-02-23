<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Tugas extends Resource
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
            'rombel' => $this->rombel->kelas . ' ' . $this->rombel->rombel,
            'mapel' => $this->mapel->nama,
            'guru' => $this->guru->nama,
            'file' => $this->file,
            'judul' => $this->judul,
            'keterangan' => $this->keterangan,
            'deadline' => $this->deadline,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
