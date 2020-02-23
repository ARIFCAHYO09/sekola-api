<?php

namespace App\Models;

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
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class Ortu extends Model implements JWTSubject, AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use HasApiTokens;
    use Authenticatable;
    use Authorizable;
    use Notifiable;
    use CanResetPassword;

    protected $table = 'ortu';
    protected $fillable = [
        'nama', 'email', 'tempat_lahir', 'tanggal_lahir', 'kelurahan_id', 'no_telepon',
        'foto', 'alamat', 'jenis_kelamin', 'pekerjaan', 'status'
    ];
    protected $hidden = [
        'password', 'remember_token'
    ];
    public function murid()
    {
        return $this->hasMany(Murid::class);
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'kode');
    }
    public function validateForPassportPasswordGrant($password)
    {
        return true;
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
        return [];
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this->email, 'ortu'));
    }
}
