<?php

namespace App\Http\Controllers;

use App\Registro_delito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware;
use Illuminate\Validation\Validator;

class RegistroDelitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoUser = Registro_delito::get();
        return $tipoUser;
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
        //     'tipo_delito'=>'required|string|max:500',
        //     'mes'=>'require|string|max:40',
        //     'anio'=>'require|string|max:4',
        // ]);
        $Registro_delito = new Registro_delito();
        $Registro_delito->id_user = Auth::user()->id;
        $Registro_delito->cantidad = $request->cantidad;
        $Registro_delito->tipo_delito = $request->delito;
        $Registro_delito->mes = $request->mes;
        $Registro_delito->anio = $request->anio;
        $Registro_delito->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registro_delito  $registro_delito
     * @return \Illuminate\Http\Response
     */
    public function show(Registro_delito $registro_delito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registro_delito  $registro_delito
     * @return \Illuminate\Http\Response
     */
    public function edit(Registro_delito $registro_delito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registro_delito  $registro_delito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registro_delito $registro_delito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registro_delito  $registro_delito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registro_delito $registro_delito)
    {
        //
    }
}
