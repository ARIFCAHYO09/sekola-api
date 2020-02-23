<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $fillable = [
        'murid_id', 'user_id', 'mapel_id', 'jenis', 'nilai', 'tahun_ajaran_id'
    ];
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
