<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranApp extends Model
{
    protected $table = 'pembayaran_ortu';
    protected $fillable = [
        'ortu_id', 'metode_pembayaran_id', 'periode_pembayaran', 'tanggal_aktivasi', 'invoice',
    ];
}
