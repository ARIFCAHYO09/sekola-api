<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tapel extends Model
{
    protected $table = 'tahun_ajaran';
    protected $fillable = [
        'semester', 'tahun_ajaran', 'status'
    ];
}
