<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankSoalMapelModel extends Model
{
    protected $table = 'bank_soal_mapel';
    protected $fillable = [
        'id', 'kategori_id', 'icon', 'nama',
    ];
}
