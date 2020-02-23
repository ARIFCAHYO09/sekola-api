<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriGaleri extends Model
{
    protected $table = 'kategori_galeri';
    protected $fillable = [
        'nama', 'keterangan'
    ];
    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }
}
