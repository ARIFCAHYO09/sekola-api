<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Ortu extends Resource
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
            'pekerjaan' => $this->pekerjaan,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tanggal_lahir' => $this->jenis_tanggal_lahir,
            'tempat_lahir' => $this->tempat_lahir,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'no_telepon' => $this->no_telepon,
            'role' => $this->role,
            'foto' => $this->foto,
            'email' => $this->email,
            '$email_verified_at' => $this->email_verified_at,
            'provinsi' => $this->kelurahan->kecamatan->kabupaten->provinsi->nama,
            'kabupaten' => $this->kelurahan->kecamatan->kabupaten->nama,
            'kecamatan' => $this->kelurahan->kecamatan->nama,
            'kelurahan' => $this->kelurahan->nama,
            'provinsi_id' => $this->kelurahan->kecamatan->kabupaten->provinsi->id,
            'kabupaten_id' => $this->kelurahan->kecamatan->kabupaten->id,
            'kecamatan_id' => $this->kelurahan->kecamatan->id,
            'kelurahan_id' => $this->kelurahan->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
