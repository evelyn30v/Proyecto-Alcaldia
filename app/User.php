<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    public function Registro_solicitud(){
        return $this->hasMany('App/Registro_solicitud');
    }
    public function Registro_delito(){
        return $this->hasMany('App/Registro_delito');
    }
    public function Registro_mp(){
        return $this->hasMany('App/Registro_mp');
    }
    public function Registro_mc(){
        return $this->hasMany('App/Registro_mc');
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'perfil', 'name', 'apellido', 'cedula', 'celular', 'tipo_usuario_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];
}
