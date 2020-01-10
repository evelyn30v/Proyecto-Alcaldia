<?php

namespace App\Http\Controllers;

use App\Citacion;
use App\Convocante;
use App\Convocado;
use App\Lugar;
use Illuminate\Http\Request;

class CitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas = Citacion::orderBy('created_at', 'DESC')->get();
        return $citas;
    }
    public function cte()
    {

    }
    // public function cdo()
    // {
    //     $cdo = Convocados::get();
    //     return $cdo;
    // }
    
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

        if ($request->lugar_cita == null) {
            $lugar = new Lugar();

            $lugar->nombre = $request->lugarInput_cita;
            $lugar->save();

            $citacion = new Citacion();

            $citacion->observacion = $request->observaciones;
            $citacion->fecha = $request->fecha_cita;
            $citacion->hora_inicio = $request->hora_cita;
            $citacion->id_lugar = $Lugar->id;
            $citacion->duracion = $request->duracion_cita;
            $citacion->tiempo = $request->tiempo_cita;
            $citacion->id_registro_caso = $request->id_caso;
            $citacion->save();

        } else if ($request->lugar_cita != null) {
            $citacion = new Citacion();

            $citacion->observacion = $request->observaciones;
            $citacion->fecha = $request->fecha_cita;
            $citacion->hora_inicio = $request->hora_cita;
            $citacion->id_lugar = $request->lugar_cita;
            $citacion->duracion = $request->duracion_cita;
            $citacion->tiempo = $request->tiempo_cita;
            $citacion->id_registro_caso = $request->id_caso;
            $citacion->save();
        }
        for ($i=0; $i < count($request["convocante.nombre"]); $i++) { 
            $convocante_cita = new Convocante();

            $convocante_cita->nombre = isset($request["convocante.nombre." . $i])?$request["convocante.nombre." . $i]:'';
            $convocante_cita->id_citacion = $citacion->id;
            $convocante_cita->save();
        }

        for ($i=0; $i < count($request["convocado.nombre"]); $i++) { 
            $convocando_cita = new Convocado();

            $convocando_cita->nombre = isset($request["convocado.nombre." . $i])?$request["convocado.nombre." . $i]:'';
            $convocando_cita->id_citacion = $citacion->id;
            $convocando_cita->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Citacion  $citacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cita = Citacion::findOrFail($id);
        return $cita;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Citacion  $citacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Citacion  $citacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        print_r($request->all());
        
        if ($request->lugar_cita == null) {
            Lugar::find($request->id_lugar_input_hidden);

            $lugar->nombre = $request->lugarInput_cita;
            $lugar->save();

            $citacion = Citacion::find($id);

            $citacion->observacion = $request->observacion;
            $citacion->fecha = $request->fecha_cita;
            $citacion->hora_inicio = $request->hora_cita;
            $citacion->id_lugar = $lugar->id;
            $citacion->id_registro_caso = $request->id_caso;
            $citacion->save();

        } else if ($request->lugar_cita != null) {
            $citacion = Citacion::find($id);

            $citacion->observacion = $request->observacion;
            $citacion->fecha = $request->fecha_cita;
            $citacion->hora_inicio = $request->hora_cita;
            $citacion->id_lugar = $request->lugar_cita;
            $citacion->id_registro_caso = $request->id_caso;
            $citacion->save();
        }
        // for ($i=0; $i < count($request["convocante.nombre"]); $i++) { 
        //     Convocante::find($request->id_convocante_input);

        //     $convocante_cita->nombre = isset($request["convocante.nombre." . $i])?$request["convocante.nombre." . $i]:'';
        //     $convocante_cita->id_citacion = $citacion->id;
        //     $convocante_cita->save();
        // }

        // for ($i=0; $i < count($request["convocado.nombre"]); $i++) { 
        //     Convocado::find($request->id_convocado_input);

        //     $convocando_cita->nombre = isset($request["convocado.nombre." . $i])?$request["convocado.nombre." . $i]:'';
        //     $convocando_cita->id_citacion = $citacion->id;
        //     $convocando_cita->save();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Citacion  $citacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citacion $citacion)
    {
        //
    }
}
