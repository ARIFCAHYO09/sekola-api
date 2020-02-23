<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PembayaranMurid extends Resource
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
            'pembayaran_siswa_id' => $this->pembayaran_siswa_id,
            'nama_murid' => $this->nama_murid,
            'biaya' => $this->biaya,
            'pembayaran' => $this->pembayaran,
            'nisn' => $this->nisn,
            'bayar_id' => $this->bayar_id,
            'murid_id' => $this->id,
            'nama_pembayaran' => $this->nama_pembayaran,
            'keterangan' => $this->keterangan,
            'status' => $this->pembayaran < $this->biaya ? 'kurang Rp.' . ($this->biaya - $this->pembayaran) : 'lunas'
        ];
    }
}
