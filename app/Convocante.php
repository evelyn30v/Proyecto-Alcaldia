<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convocante extends Model
{
    public function Convocante_cita(){
        return $this->hasMany('App/Convocante_cita');
    }
}
