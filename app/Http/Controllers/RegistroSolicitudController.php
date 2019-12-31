<?php

namespace App\Http\Controllers;

use App\Registro_solicitud;
use App\Solicitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware;
use Validator;

class RegistroSolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $solicitud = Registro_solicitud::get();
        return $solicitud;
        
    }
    public function view()
    {
        $solicitante = Solicitante::get();
        return $solicitante;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return (Auth::user()->id());
        //dd(Auth::user()->id());
        // $id = auth()->User()->id;
        // return $id;
        // $this->validate($request,[
        //     'motivo'=>'require|string|max:1500',
        //     'estado'=>'require|string',
        //     'observacion'=>'require|string|max:1500',
        //     'fecha'=>'require|date',
        // ]);
        
        if ($request->id_solicitante_input == null ){
            print_r ("if");
        $solicitante=new Solicitante();
        $solicitante->nombre = $request->nombre;
        $solicitante->apellido = $request->apellido;
        $solicitante->tipo_documento = $request->tipo_doc;
        $solicitante->no_documento = $request->documento;
        $solicitante->save();

        $registro_solicitud = new Registro_solicitud();
        $registro_solicitud->motivo = $request->motivo;
        $registro_solicitud->estado = $request->estado;
        $registro_solicitud->observacion = $request->observacion;
        // $registro_solicitud->fecha = $request->fecha;
        $registro_solicitud->id_solicitante = $solicitante->id;
        // $registro_solicitud->id_user = 5;
        $registro_solicitud->id_user = Auth::user()->id;
        $registro_solicitud->save();
        }
        else{
           //print_r ("else");
        $registro_solicitud = new Registro_solicitud();
        $registro_solicitud->motivo = $request->motivo;
        $registro_solicitud->estado = $request->estado;
        $registro_solicitud->observacion = $request->observacion;
        // $registro_solicitud->fecha = $request->fecha;
        $registro_solicitud->id_solicitante = $request->id_solicitante_input;
        // $registro_solicitud->id_user = 5;
        $registro_solicitud->id_user = Auth::user()->id;
        $registro_solicitud->save();
        }
    }
    // public function solicitante(Request $request)
    // {
    //     $solicitante=new Solicitante();
    //     $solicitante->nombre = $request->nombre;
    //     $solicitante->apellido = $request->apellido;
    //     $solicitante->tipo_documento = $request->tipo_doc;
    //     $solicitante->no_documento = $request->documento;
    //     $solicitante->save();
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registro_solicitud  $registro_solicitud
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registro_solicitud = Registro_solicitud::findOrFail($id);
        return $registro_solicitud;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registro_solicitud  $registro_solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Registro_solicitud $registro_solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registro_solicitud  $registro_solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // print_r("hola");
        if ($request->id_solicitante_input == null ){
            print_r ("if");
        $solicitante = Solicitante::find($request->id_solicitante);
        $solicitante->nombre = $request->nombre;
        $solicitante->apellido = $request->apellido;
        $solicitante->tipo_documento = $request->tipo_doc;
        $solicitante->no_documento = $request->documento;
        $solicitante->save();

        $registro_solicitud = Registro_solicitud::find($id);
        $registro_solicitud->motivo = $request->motivo;
        $registro_solicitud->estado = $request->estado;
        $registro_solicitud->observacion = $request->observacion;
        // $registro_solicitud->fecha = $request->fecha;
        $registro_solicitud->id_solicitante = $solicitante->id;
        // $registro_solicitud->id_user = 5;
        $registro_solicitud->id_user = Auth::user()->id;
        $registro_solicitud->save();
        }
        else{
           //print_r ("else");
           $registro_solicitud = Registro_solicitud::find($id);
        $registro_solicitud->motivo = $request->motivo;
        $registro_solicitud->estado = $request->estado;
        $registro_solicitud->observacion = $request->observacion;
        // $registro_solicitud->fecha = $request->fecha;
        $registro_solicitud->id_solicitante = $request->id_solicitante_input;
        // $registro_solicitud->id_user = 5;
        $registro_solicitud->id_user = Auth::user()->id;
        $registro_solicitud->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registro_solicitud  $registro_solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registro_solicitud $registro_solicitud, $id)
    {
        	
        Registro_solicitud::destroy($id);
    }
}
