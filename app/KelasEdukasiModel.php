<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelasEdukasiModel extends Model
{
    protected $table = 'kelas_edukasi';
    protected $fillable = [
        'id', 'nama',
    ];
}
