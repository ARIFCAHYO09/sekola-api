<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoalMapelModel extends Model
{
    protected $table = 'bank_soal';
    protected $fillable = [
        'id', 'nama', 'jumlah_soal', 'skoring', 'level',
    ];
}