<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $table = 'ekskul';
    protected $fillable = [
        'nama', 'keterangan', 'sekolah_id'
    ];

    public function murid()
    {
        return $this->hasMany(Murid::class, 'ekskul_murid', 'ekskul_id', 'murid_id');
    }

    public function jadwal()
    {
        return $this->hasOne(JadwalEkstra::class, 'ekskul_id');
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'ekskul_id');
    }
}
