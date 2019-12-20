<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    public function Citacion(){
        return $this->hasMany('App/Citacion');
    }
}
