<?php

namespace App\Http\Controllers;

use App\Involucrado;
use Illuminate\Http\Request;

class InvolucradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'=>'request|string|max:500',
            'fecha_nacimiento'=>'request|date',
            'genero'=>'request|string|max:50',
            'enfoque_diferencial'=>'request|string|max:500',
            'estado_civil'=>'request|string|max:100',
            'grado_escolaridad'=>'request|string|max:500',
            'tipo_documento'=>'request|string|max:100',
            'no_documento'=>'request|string|max:10',
            'fecha_exp_documento'=>'request|date',
            'estrato'=>'request|string|max:2',
            'correo'=>'request|string|max:190',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Involucrado  $involucrado
     * @return \Illuminate\Http\Response
     */
    public function show(Involucrado $involucrado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Involucrado  $involucrado
     * @return \Illuminate\Http\Response
     */
    public function edit(Involucrado $involucrado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Involucrado  $involucrado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Involucrado $involucrado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Involucrado  $involucrado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Involucrado $involucrado)
    {
        //
    }
}
