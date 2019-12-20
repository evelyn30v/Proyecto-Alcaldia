<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro_solicitud extends Model
{
    // protected $fillable = ['motivo','estado','observacion','fecha','id_solicitante']
    public function user(){
        return $this->hasMany('App/User');
    }
    public function solicitante(){
        return $this->hasMany(Solicitante::class);
    }
}
