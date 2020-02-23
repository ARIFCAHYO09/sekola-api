<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EkskulMurid extends Model
{
    protected $table = 'ekskul_murid';
    protected $fillable = [
        'murid_id', 'ekskul_id'
    ];

    public function murid()
    {
        return $this->belongsTo(Murid::class);
    }
    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class, 'ekskul_id');
    }
    public function jadwal()
    {
        return $this->belongsTo(JadwalEkstra::class, 'ekskul_id');
    }
}
