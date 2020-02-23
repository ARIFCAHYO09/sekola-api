<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Models\PembayaranSiswa;

class PembayaranOrtu extends Resource
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
            // 'rombel' =>
            // $this->rombel != null ? $this->rombel->kelas . ' ' . $this->rombel->rombel : 'semua',
            'nama' => $this->nama,
            'keterangan' => $this->keterangan,
            'pembayaran' => $this->pembayaran,
            'biaya' => $this->biaya,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->pembayaran < $this->biaya ? 'kurang Rp.' . ( $this->biaya - $this->pembayaran ) : 'lunas',
        ];
    }
}
