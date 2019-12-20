<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    public function Involucrado(){
        return $this->hasMany('App/Involucrado');
    }
    public function Departamento(){
        return $this->hasMany('App/Departamento');
    }
}
