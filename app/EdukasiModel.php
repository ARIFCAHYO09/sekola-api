<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EdukasiModel extends Model
{
    protected $table = 'edukasi';
    protected $fillable = [
        'id', 'nama',
    ];
}
