<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_usuario extends Model
{
    protected $fillable = [
        'nombre',
    ];
    public function user(){
        return $this->hasMany('App/User');
    }
}
