<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeOTP extends Model
{
    protected $table = 'kode_otp';
    protected $fillable = [
        'user_id', 'token', 'model'
    ];
}
