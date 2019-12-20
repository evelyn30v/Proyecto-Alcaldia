<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public function Involucrado(){
        return $this->hasMany('App/Involucrado');
    }
}
