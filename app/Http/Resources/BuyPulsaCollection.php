<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BuyPulsaCollection extends ResourceCollection
{
    private $test;

    public function __construct($resource, $test)
    {
        parent::__construct($resource);
        $this->test = $test;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'kode' => 200,
            'message' => $this->test,
        ];
    }
}