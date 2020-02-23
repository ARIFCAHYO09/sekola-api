<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OperatorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code' => 200,
            'message' => 'Berhasil ambil data',
            'data' => ($request->has('prefix') && strlen($request->prefix) >= 4) ? $this->collection[0] : $this->collection,
        ];
    }
}