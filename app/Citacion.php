<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Citacion extends Model
{
    public function Convocante_cita(){
        return $this->hasMany('App/Convocante_cita');
    }
    public function Convocado_cita(){
        return $this->hasMany('App/Convocado_cita');
    }
}
