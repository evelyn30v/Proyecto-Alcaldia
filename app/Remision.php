<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remision extends Model
{
    public function Registro_caso(){
        return $this->hasMany('App/Registro_caso');
    }
}
