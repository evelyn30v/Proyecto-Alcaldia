<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_delito extends Model
{
    public function Motivo(){
        return $this->hasMany('App/Motivo');
    }
    public function Registro_delito(){
        return $this->hasMany('App/Registro_delito');
    }
}
