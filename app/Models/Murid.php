<?php

namespace App\Models;

use App\Models\Tugas;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    protected $table = 'murid';
    protected $fillable = [
        'nisn', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat',
        'sekolah_id', 'status', 'rombel_id', 'kelurahan_id','email', 'no_telepon', 'ortu_id', 'status_pembayaran_ortu'
    ];
    public static function laratablesCustomAction($murid)
    {
        return view('sekolah.murid.action', compact('murid'))->render();
    }
    public static function laratablesCustomGambar($murid)
    {
        $data = Murid::find($murid->id);
        if (file_exists($data->foto)) {
            return 'storage/' . $data->foto;
        } else {
            return "gambar tidak ditemukan";
        }
    }
    public function ortu()
    {
        return $this->belongsTo(Ortu::class);
    }
    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }
    public function ekstra()
    {
        return $this->belongsToMany(Ekskul::class);
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'kode');
    }
}
