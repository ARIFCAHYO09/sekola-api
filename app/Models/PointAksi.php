<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointAksi extends Model
{

    protected $table = 'point_aksi';
    protected $fillable = [
        'nama', 'point', 'keterangan', 'sekolah_id'
    ];
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }
}
