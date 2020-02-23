<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewSoalUserModel extends Model
{
    protected $table = 'review_jawaban';
    protected $fillable = [
        'id', 'user_id', 'soal_id', 'no_soal', 'jawaban',
    ];
}