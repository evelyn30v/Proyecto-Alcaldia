<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro_caso extends Model
{
    protected $fillable = [
        'id_user', 'id_motivo', 'id_remision'
    ];

    // public function Citacion(){
    //     return $this->hasMany('App/Citacion');
    // }
    // public function Involucrado_caso(){
    //     return $this->hasMany('App/Involucrado_caso');
    // }
}
