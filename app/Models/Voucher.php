<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher';
    protected $fillable = [
        'nama', 'point', 'keterangan', 'gambar', 'merchant_id', 'kode', 'status', 'expired_date'
    ];
    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }
}
