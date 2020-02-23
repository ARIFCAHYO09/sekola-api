<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserNotif extends Resource
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
            // 'type' => $this->type,
            // 'notifiable_type' => $this->notifiable_type,
            // 'notifiable_id' => $this->notifiable_id,
            'data' => $this->data
        ];
    }
}
