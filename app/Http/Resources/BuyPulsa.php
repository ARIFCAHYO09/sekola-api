<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BuyPulsa extends Resource
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
            'nominal' => $this->nominal->nominal,
            'poin' => $this->nominal->poin,
            'operator' => $this->operator->name,
            'pay_methode' => $this->pay_methode,
            'phone' => $this->no_hp,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}