<?php

namespace App\Http\Resources;

use App\Models\Mapel;
use App\Models\Rombel;
use Illuminate\Http\Resources\Json\Resource;

class User extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $mapel = json_decode($this->mapel_id);
        $mapels = [];
        if($mapel != null) {
            foreach($mapel as $m) {
                array_push($mapels, Mapel::find($m)->nama);
            }
        }
        $mapel = json_decode($this->mapel_id);
        $rombels = [];
        if ($mapel != null) {
            foreach ($mapel as $m) {
                array_push($rombels, Rombel::find($m)->kelas . ' ' .Rombel::find($m)->rombel);
            }
        }
        return [
            'id' => $this->id,
            'nuptk' => $this->nuptk,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tanggal_lahir' => $this->tanggal_lahir,
            'tempat_lahir' => $this->tempat_lahir,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'no_telepon' => $this->no_telepon,
            'role' => $this->role,
            'status' => $this->status,
            'foto' => $this->foto,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'point' => $this->point,
            'provinsi' => $this->kelurahan->kecamatan->kabupaten->provinsi->nama,
            'kabupaten' => $this->kelurahan->kecamatan->kabupaten->nama,
            'kecamatan' => $this->kelurahan->kecamatan->nama,
            'kelurahan' => $this->kelurahan->nama,
            'provinsi_id' => $this->kelurahan->kecamatan->kabupaten->provinsi->id,
            'kabupaten_id' => $this->kelurahan->kecamatan->kabupaten->id,
            'kecamatan_id' => $this->kelurahan->kecamatan->id,
            'kelurahan_id' => $this->kelurahan->id,
            'sekolah' => $this->sekolah->nama,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'mapel' => $mapels,
            'rombel' => $rombels
        ];
    }
}
