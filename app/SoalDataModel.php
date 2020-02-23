<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoalDataModel extends Model
{
    protected $table = 'bank_soal_detail';
    protected $fillable = [
        'id', 'nama', 'no_soal', 'nama', 'pilihan_A', 'pilihan_B', 'pilihan_C', 'pilihan_D',
        'jawaban', 'penjelasan',
    ];
}