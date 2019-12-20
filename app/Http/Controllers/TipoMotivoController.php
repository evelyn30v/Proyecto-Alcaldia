<?php

namespace App\Http\Controllers;

use App\Tipo_motivo;
use Illuminate\Http\Request;

class TipoMotivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motivo = Tipo_motivo::get();
        return $motivo;
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
     * @param  \App\Tipo_motivo  $tipo_motivo
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo_motivo $tipo_motivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipo_motivo  $tipo_motivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo_motivo $tipo_motivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipo_motivo  $tipo_motivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipo_motivo $tipo_motivo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipo_motivo  $tipo_motivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo_motivo $tipo_motivo)
    {
        //
    }
}
