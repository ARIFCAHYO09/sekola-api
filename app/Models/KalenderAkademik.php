<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KalenderAkademik extends Model
{
    protected $table = 'kalender_akademik';
    protected $fillable = [
        'judul', 'jenis', 'tanggal', 'keterangan', 'sekolah_id', 'status'
    ];
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
