<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convocado extends Model
{
    public function Convocado_cita(){
        return $this->hasMany('App/Convocado_cita');
    }
}
