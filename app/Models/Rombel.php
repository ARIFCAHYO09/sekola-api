<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Galeri;

class Rombel extends Model
{
    protected $table = 'rombel';
    protected $fillable = [
        'kelas', 'rombel', 'keterangan', 'sekolah_id'
    ];

    public function murid()
    {
        return $this->hasMany(Murid::class);
    }
    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }
    public function japel()
    {
        return $this->hasMany(Japel::class);
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
