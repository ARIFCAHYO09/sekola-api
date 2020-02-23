<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankSoalKategoriModel extends Model
{
    protected $table = 'bank_soal_kategori';
    protected $fillable = [
        'id', 'icon', 'nama',
    ];
}
