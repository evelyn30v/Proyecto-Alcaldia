<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    public function Registro_solicitud(){
        return $this->hasMany('App/Registro_solicitud');
    }
    public function Solicitud()
    {
        return $this->belongsTo(Registro_solicitud::class);
    }
}
