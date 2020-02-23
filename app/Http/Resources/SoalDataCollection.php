<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SoalDataCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'kode' => 200,
            'message' => 'Berhasil ambil data',
        ];
    }
}