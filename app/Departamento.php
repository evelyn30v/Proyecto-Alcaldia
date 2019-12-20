<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    public function Ciudad(){
        return $this->hasMany('App/Ciudad');
    }
}
