<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NominalModel extends Model
{
    protected $table = 'nominal';
    protected $fillable = [
        'id', 'nominal', 'poin',
    ];

}