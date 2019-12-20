<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    public function Contacto(){
        return $this->hasMany('App/Contacto');
    }
    public function Motivo(){
        return $this->hasMany('App/Motivo');
    }
}
