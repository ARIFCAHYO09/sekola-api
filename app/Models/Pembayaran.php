<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = [
        'nama', 'keterangan', 'rombel_id', 'biaya'
    ];
    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }
    public function pembayaranSiswa()
    {
        return $this->hasMany(PembayaranSiswa::class);
    }
}
