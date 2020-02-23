<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointTransaksi extends Model
{

    protected $table = 'point_transaksi';
    protected $fillable = [
        'user_id', 'point_aksi_id', 'point', 'status', 'rombel_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pointAksi()
    {
        return $this->belongsTo(PointAksi::class);
    }
    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }
}
