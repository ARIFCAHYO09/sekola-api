<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranSiswa extends Model
{
    protected $table = 'pembayaran_siswa';
    protected $fillable = [
        'nama', 'bayar_id', 'murid_id', 'pembayaran'
    ];
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }
    public function murid()
    {
        return $this->belongsTo(Murid::class);
    }
}
