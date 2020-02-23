<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkorUserModel extends Model
{
    protected $table = 'skor_user';
    protected $fillable = [
        'id', 'user_id', 'soal_id', 'jumlah_benar', 'jumlah_salah', 'skor',
    ];
}