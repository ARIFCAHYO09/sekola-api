<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Tapel extends Resource
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
            'semester' => $this->semester,
            'tahun_ajaran' => $this->tahun_ajaran,
            'nama' => $this->semester . ' ' . $this->tahun_ajaran,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
