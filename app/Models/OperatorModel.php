<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperatorModel extends Model
{
    protected $table = 'operator';
    protected $fillable = [
        'id', 'logo', 'prefixs', 'name',
    ];
}