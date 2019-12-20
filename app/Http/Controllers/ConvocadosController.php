<?php

namespace App\Http\Controllers;

use App\Convocados;
use Illuminate\Http\Request;

class ConvocadosController extends Controller
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
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Convocados  $convocados
     * @return \Illuminate\Http\Response
     */
    public function show(Convocados $convocados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Convocados  $convocados
     * @return \Illuminate\Http\Response
     */
    public function edit(Convocados $convocados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Convocados  $convocados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Convocados $convocados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Convocados  $convocados
     * @return \Illuminate\Http\Response
     */
    public function destroy(Convocados $convocados)
    {
        //
    }
}
