<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rombel;
use App\Models\User;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $fillable = [
        'user_id', 'rombel_id', 'gambar'
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function rombel()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriGaleri::class);
    }
}
