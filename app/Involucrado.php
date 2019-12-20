<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Involucrado extends Model
{
    public function Involucrado_caso(){
        return $this->hasMany('App/Involucrado_caso');
    }
}
