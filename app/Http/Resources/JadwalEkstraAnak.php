<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Models\User;

class JadwalEkstraAnak extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $guru = json_decode($this->jadwal->guru_id);
        $pembina = [];
        if($guru != null) {
            foreach ($guru as $g) {
                array_push($pembina, User::find($g)->nama);
            }
        }
        return [
            'id' => $this->jadwal->id,
            'ekskul' => $this->jadwal->ekskul->nama,
            'jam_mulai' => $this->jadwal->jam_mulai,
            'jam_akhir' => $this->jadwal->jam_akhir,
            'hari' => $this->jadwal->hari,
            'tempat' => $this->jadwal->tempat,
            'pembina'=> $pembina
        ];
    }
}
