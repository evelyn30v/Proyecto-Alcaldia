<?php

namespace App\Http\Controllers;

use App\Tipo_usuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoUser = Tipo_usuario::get();
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
        $this->validate($request,[
            'nombre'=>'required|string|max:500',
        ]);

        $Tipo_usuario = new Tipo_usuario();
        $Tipo_usuario->nombre = $request->nombre;
        $Tipo_usuario->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipo_usuario  $tipo_usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo_usuario $tipo_usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipo_usuario  $tipo_usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo_usuario $tipo_usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipo_usuario  $tipo_usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Tipo_usuario::find($id)->update($request->all());
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipo_usuario  $tipo_usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo_usuario $tipo_usuario, $id)
    {
        Tipo_usuario::destroy($id);
    }
}
