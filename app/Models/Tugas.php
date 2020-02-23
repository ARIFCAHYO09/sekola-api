<?php

namespace App\Models;

use App\Models\Rombel;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';
    protected $fillable = [
        'user_id', 'rombel_id', 'file', 'keterangan', 'judul', 'mapel_id', 'deadline'
    ];
    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function rombel()
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'rombel_id');
    }
}
