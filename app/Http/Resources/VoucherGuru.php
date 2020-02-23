<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class VoucherGuru extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'voucher_nama' => $this->voucher->nama,
            'voucher_kode' => $this->voucher->kode,
            'voucher_gambar'=> $this->voucher->gambar,
            'voucher_status' => $this->voucher->status,
            'expired' => $this->voucher->expired_date,
            'merchant' => $this->voucher->merchant->nama,
            'alamat_merchant' => $this->voucher->merchant->alamat,
        ];
    }
}
