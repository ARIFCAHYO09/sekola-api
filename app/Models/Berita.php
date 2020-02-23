<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    protected $fillable = [
        'judul', 'gambar', 'status', 'user_id', 'sekolah_id'
    ];
    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }
}
