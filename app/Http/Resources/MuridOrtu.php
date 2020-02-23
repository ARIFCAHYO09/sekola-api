<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MuridOrtu extends Resource
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
            'nisn' => $this->nisn,
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin == 'l' ? 'Laki-Laki' : 'Perempuan',
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'status' => $this->status,
            'rombel_id' => $this->rombel_id,
            'rombel' => $this->rombel->kelas . $this->rombel->rombel,
            'foto' => $this->foto,
            // 'ortu_nama' => $this->ortu->nama,
            'ortu_id' => $this->ortu_id,
            'kelurahan' => $this->kelurahan->nama,
            'kecamatan' => $this->kelurahan->kecamatan->nama,
            'kabupaten' => $this->kelurahan->kecamatan->kabupaten->nama,
            'provinsi' => $this->kelurahan->kecamatan->kabupaten->provinsi->nama,
            'kelurahan_id' => $this->kelurahan->id,
            'kecamatan_id' => $this->kelurahan->kode,
            'kabupaten_id' => $this->kelurahan->kecamatan->kabupaten->id,
            'provinsi_id' => $this->kelurahan->kecamatan->kabupaten->provinsi->id,
            'kelurahan_kode' => $this->kelurahan->kode,
            'kecamatan_kode' => $this->kelurahan->kecamatan->kode,
            'kabupaten_kode' => $this->kelurahan->kecamatan->kabupaten->kode,
            'provinsi_kode' => $this->kelurahan->kecamatan->kabupaten->provinsi->kode,
            'status_ortu' => $this->ortu_id == null ? 'tidak ada' : 'sudah ada',
        ];
    }
}
