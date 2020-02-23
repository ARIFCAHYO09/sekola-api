<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';
    protected $fillable = ['murid_id', 'mapel_id', 'user_id', 'tahun_ajaran_id', 'status', 'created_at'];

    public function murid()
    {
        return $this->belongsTo(Murid::class, 'murid_id');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function tapel()
    {
        return $this->belongsTo(Tapel::class, 'tahun_ajaran_id');
    }
}
