<?php

namespace App\Http\Controllers;

use App\Registro_delito;
use App\Registro_mc;
use App\Registro_mp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware;
use Illuminate\Validation\Validator;
use Carbon\Carbon;

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
    public function reportes(Request $request)
    {
        // print_r($request->all());
        $get_anio_i = $request->anio_i;
        $get_anio_f = $request->anio_f;
        $get_delito = $request->delitos_report;

        if ($get_delito != 1)  {
            $tipoUser = Registro_delito::whereBetween('anio',[$get_anio_i, $get_anio_f])
                ->where('tipo_delito', [$get_delito])->orderBy('anio', 'ASC')->get();
            return $tipoUser;
        }
        elseif ($get_delito == 1) {
            $tipoUser = Registro_delito::whereBetween('anio',[$get_anio_i, $get_anio_f])->get();
            return $tipoUser;
        }
        
    }
    public function reportes_mc_anio(Request $request)
    {
        // print_r($request->all());
        $get_anio_i = $request->anio_i;
        $get_anio_f = $request->anio_f;
        $get_delito = $request->delitos_report;

        if ($get_delito != 0)  {
            $reportes_mc = Registro_mc::whereBetween('anio',[$get_anio_i, $get_anio_f])
                ->where('tipo_delito', [$get_delito])->orderBy('anio', 'ASC')->get();
            return $reportes_mc;
        }
        elseif ($get_delito == 0) {
            $reportes_mc = Registro_mc::whereBetween('anio',[$get_anio_i, $get_anio_f])->get();
            return $reportes_mc;
        }
        
    }
    public function reportes_mp_anio(Request $request)
    {
        // print_r($request->all());
        $get_anio_i = $request->anio_i;
        $get_anio_f = $request->anio_f;
        $get_delito = $request->delitos_report;

        if ($get_delito != 0)  {
            $reportes_mp = Registro_mp::whereBetween('anio',[$get_anio_i, $get_anio_f])
                ->where('tipo_delito', [$get_delito])->orderBy('anio', 'ASC')->get();
            return $reportes_mp;
        }
        elseif ($get_delito == 0) {
            $reportes_mp = Registro_mp::whereBetween('anio',[$get_anio_i, $get_anio_f])->get();
            return $reportes_mp;
        }
        
    }
    public function reportes_mc_mes(Request $request)
    {
        $get_mes_i = $request->mes_i;
        $get_mes_f = $request->mes_f;
        $get_anio_mes = $request->an_me;
        $get_delito = $request->delitos_report;

        if ($get_delito != 0)  {
            $mes_get_reporte = Registro_mc::whereBetween('mes',[$get_mes_i, $get_mes_f])
                ->where('tipo_delito', [$get_delito])->orderBy('mes', 'ASC')
                ->where('anio',[$get_anio_mes])->get();
            return $mes_get_reporte;
        }
        elseif ($get_delito == 0) {
            $mes_get_reporte = Registro_mc::whereBetween('mes',[$get_mes_i, $get_mes_f])
            ->where('anio',[$get_anio_mes])->get();
            return $mes_get_reporte;
        }
        
    }
    public function reportes_mp_mes(Request $request)
    {
        $get_mes_i = $request->mes_i;
        $get_mes_f = $request->mes_f;
        $get_anio_mes = $request->an_me;
        $get_delito = $request->delitos_report;

        if ($get_delito != 0)  {
            $mes_get_reporte = Registro_mp::whereBetween('mes',[$get_mes_i, $get_mes_f])
                ->where('tipo_delito', [$get_delito])->orderBy('mes', 'ASC')
                ->where('anio',[$get_anio_mes])->get();
            return $mes_get_reporte;
        }
        elseif ($get_delito == 0) {
            $mes_get_reporte = Registro_mp::whereBetween('mes',[$get_mes_i, $get_mes_f])
            ->where('anio',[$get_anio_mes])->get();
            return $mes_get_reporte;
        }
        
    }
    public function mes_reportes (Request $request)
    {
        // print_r($request->all());
        $get_mes_i = $request->mes_i;
        $get_mes_f = $request->mes_f;
        $get_anio_mes = $request->an_me;
        $get_delito = $request->delitos_report;

        if ($get_delito != 0)  {
            $mes_get_reporte = Registro_delito::whereBetween('mes',[$get_mes_i, $get_mes_f])
                ->where('tipo_delito', [$get_delito])->orderBy('mes', 'ASC')
                ->where('anio',[$get_anio_mes])->get();
            return $mes_get_reporte;
        }
        elseif ($get_delito == 0) {
            $mes_get_reporte = Registro_delito::whereBetween('mes',[$get_mes_i, $get_mes_f])
            ->where('anio',[$get_anio_mes])->get();
            return $mes_get_reporte;
        }
        
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
