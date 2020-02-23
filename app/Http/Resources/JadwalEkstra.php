<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Models\User;

class JadwalEkstra extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $guru = json_decode($this->guru_id);
        $pembina = [];
        if ($guru != null) {
            foreach ($guru as $g) {
                array_push($pembina, User::find($g)->nama);
            }
        }
        return [
            'id' => $this->id,
            'ekskul' => $this->ekskul->nama,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'hari' => $this->hari,
            'tempat' => $this->tempat,
            'pembina' => $pembina
        ];
    }
}
