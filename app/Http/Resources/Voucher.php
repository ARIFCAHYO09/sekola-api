<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Voucher extends Resource
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
            'point' => $this->point,
            'merchant' => $this->merchand_id == null ?  "Pulsa/Token" : $this->merchant->nama,
            'kode' => $this->kode,
            'nama' => $this->nama,
            'gambar' => $this->gambar,
            'expired_date' => $this->expired_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
