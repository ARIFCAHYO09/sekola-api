<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Japel extends Model
{
    protected $table = 'jadwal_pelajaran';
    protected $fillable = [
        'user_id', 'ruang_id', 'jam-mulai', 'jam_akhir', 'hari', 'tahun_ajaran_id', 'mapel_id'
    ];
    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tapel()
    {
        return $this->belongsTo(Tapel::class, 'tahun_ajaran_id');
    }
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'ruang_id');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
    public function rombel()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }
}
