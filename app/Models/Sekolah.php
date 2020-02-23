<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';

    protected $fillable = [
        'nama', 'npsn', 'jenjang_pendidikan_id'
    ];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'kode');
    }

    public function kalender()
    {
        return $this->hasMany(KalenderAkademik::class);
    }
    public function berita()
    {
        return $this->hasMany(Berita::class);
    }
    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_pendidikan_id');
    }
}
