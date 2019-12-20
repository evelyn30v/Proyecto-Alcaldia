<?php

namespace App\Http\Controllers;

use App\Registro_mp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware;
use Illuminate\Validation\Validator;


class RegistroMpController extends Controller
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
        $Registro_mp = new Registro_mp();
        $Registro_mp->id_user = Auth::user()->id;
        $Registro_mp->observacion = $request->observacion;
        $Registro_mp->tipo_delito = $request->delito;
        $Registro_mp->mes = $request->mes;
        $Registro_mp->anio = $request->anio;
        $Registro_mp->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registro_mp  $registro_mp
     * @return \Illuminate\Http\Response
     */
    public function show(Registro_mp $registro_mp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registro_mp  $registro_mp
     * @return \Illuminate\Http\Response
     */
    public function edit(Registro_mp $registro_mp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registro_mp  $registro_mp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registro_mp $registro_mp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registro_mp  $registro_mp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registro_mp $registro_mp)
    {
        //
    }
}
