<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_motivo extends Model
{
    public function Registro_caso(){
        return $this->hasMany('App/Registro_caso');
    }
}
