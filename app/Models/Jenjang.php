<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    protected $table = 'jenjang_pendidikan';
    protected $fillable = [
        'nama', 'keterangan'
    ];
    public function sekolah()
    {
        return $this->hasMany(Sekolah::class);
    }
}
