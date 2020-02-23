<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalEkstra extends Model
{
    protected $table = 'jadwal_ekskul';
    protected $fillable = [
        'user_id', 'tempat', 'jam-mulai', 'jam_akhir', 'hari', 'tahun_ajaran_id', 'ekskul_id'
    ];
    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tapel()
    {
        return $this->belongsTo(Tapel::class, 'tahun_ajaran_id');
    }
    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class, 'ekskul_id');
    }
}
