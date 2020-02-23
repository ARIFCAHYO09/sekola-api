<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserVoucher extends Model
{
    protected $table = 'user_voucher';
    protected $fillable = [
        'user_id', 'voucher_id', 'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }
}
