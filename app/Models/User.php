<?php

namespace App\Models;

use App\Http\Resources\GaleriCollection;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Notifications\ResetPasswordNotification;

class User extends Model implements JWTSubject, AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use HasApiTokens;
    use Authenticatable;
    use Authorizable;
    use Notifiable;
    use CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email','sekolah_id', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat',
        'point', 'no_telepon', 'nuptk', 'role', 'status', 'foto', 'kelurahan_id'
    ];



    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'kode');
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function japel()
    {
        return $this->hasMany(Japel::class);
    }

    public function jadwalEkstra()
    {
        return $this->hasMany(JadwalEkstra::class);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return ['id'];
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this->email, 'guru'));
    }
    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }
}
