<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Nominal extends Resource
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
            'nominal' => $this->nominal,
            'poin' => $this->poin,
        ];
    }
}