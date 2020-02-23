<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MapelSoalCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


        $dataMain = [
            'code' => 200,
            'message' => 'Berhasil ambil data',
            'data' => $this->collection,
        ];

        return $dataMain;

    }
}
