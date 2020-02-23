<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResetPass extends Model
{
    protected $table = 'password_resets_api';
    protected $fillable = ['model', 'model_id', 'token', 'otp'];
}
