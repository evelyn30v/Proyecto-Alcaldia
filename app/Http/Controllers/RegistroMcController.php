<?php

namespace App\Http\Controllers;

use App\Registro_mc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware;
use Illuminate\Validation\Validator;

class RegistroMcController extends Controller
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
        // $this->validate($request,[
        //     'observacion'=>'request|string|max:1500',
        //     'mes'=>'request|string|max:40',
        //     'anio'=>'request|string|max:4',
        // ]);
        $Registro_mc = new Registro_mc();
        $Registro_mc->id_user = Auth::user()->id;
        $Registro_mc->observacion = $request->observacion;
        $Registro_mc->tipo_delito = $request->delito;
        $Registro_mc->mes = $request->mes;
        $Registro_mc->anio = $request->anio;
        $Registro_mc->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registro_mc  $registro_mc
     * @return \Illuminate\Http\Response
     */
    public function show(Registro_mc $registro_mc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registro_mc  $registro_mc
     * @return \Illuminate\Http\Response
     */
    public function edit(Registro_mc $registro_mc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registro_mc  $registro_mc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registro_mc $registro_mc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registro_mc  $registro_mc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registro_mc $registro_mc)
    {
        //
    }
}
