<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Operator extends Resource
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
            'logo' => $this->logo ? url('logo_operator/' . $this->logo) : '',
            'prefix' => $this->prefix,
            'name' => $this->name,
        ];
    }
}
