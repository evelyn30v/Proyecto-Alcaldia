<?php

namespace App\Http\Controllers;

use App\Registro_caso;
use App\Remision;
use App\Motivo;
use App\Tipo_motivo;
use App\Tipo_delito;
use App\Involucrado;
use App\Contacto;
use App\Citacion;
use App\Caso_involucrado;
use App\Lugar;
use App\Convocante;
use App\Convocado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware;
use DateTime;


class RegistroCasoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casos = Registro_caso::get();
        return $casos;
    }
    public function involucrado()
    {
        $casos = Involucrado::get();
        return $casos;
    }
    public function remision()
    {
        $casos = Remision::get();
        return $casos;
    }
    public function motivo()
    {
        $casos = Motivo::get();
        return $casos;
    }
    public function reportes_anio(Request $request)
    {
        // print_r($request->all());
        $get_anio_i = $request->anio_i;
        $get_anio_f = $request->anio_f;
        $get_delito = $request->delitos_report;

        // if ($get_delito != 0)  {
            // $tipoUser = Registro_caso::whereBetween('created_at',[$get_anio_i, $get_anio_f])
            //     ->where('tipo_delito', [$get_delito])->orderBy('created_at', 'ASC')->get();
            // return $tipoUser;
        // }
        // elseif ($get_delito == 0) {
            $casos = Registro_caso::whereBetween('created_at',[$get_anio_i, $get_anio_f])->get();
            return $casos;
        // }
        
    }
    public function conciliados(Request $request){
        $get_anio_i = $request->anio_i;
        $get_anio_f = $request->anio_f;
        
        $tipoUser = Registro_caso::whereBetween('created_at',[$get_anio_i, $get_anio_f])
                ->where('estado', 'Conciliado')->orderBy('created_at', 'ASC')->get();
            return $tipoUser;
    }

    public function no_acuerdo(Request $request)
    {
        $get_anio_i = $request->anio_i;
        $get_anio_f = $request->anio_f;
        
        $tipoUser = Registro_caso::whereBetween('created_at',[$get_anio_i, $get_anio_f])
                ->where('estado', 'No acuerdo')->orderBy('created_at', 'ASC')->get();
            return $tipoUser;
        
    }
    public function resuelto(Request $request)
    {
        $get_anio_i = $request->anio_i;
        $get_anio_f = $request->anio_f;
        
        $tipoUser = Registro_caso::whereBetween('created_at',[$get_anio_i, $get_anio_f])
                ->where('estado', 'Resuelto')->orderBy('created_at', 'ASC')->get();
            return $tipoUser;
        
    }
    public function remitido(Request $request)
    {
        $get_anio_i = $request->anio_i;
        $get_anio_f = $request->anio_f;
        
        $tipoUser = Registro_caso::whereBetween('created_at',[$get_anio_i, $get_anio_f])
                ->where('id_remision','>', '1')->orderBy('created_at', 'ASC')->get();
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
    public function reportes(Request $request)
    {
        // print_r($request->all());
        $get_anio_i = $request->anio_i;
        $get_anio_f = $request->anio_f;
        $get_delito = $request->delitos_report;

        if ($get_delito != 0)  {
            $tipoUser = Registro_caso::whereBetween('created_at',[$get_anio_i, $get_anio_f])
                ->where('tipo_delito', [$get_delito])->orderBy('created_at', 'ASC')->get();
            return $tipoUser;
        }
        elseif ($get_delito == 0) {
            $tipoUser = Registro_caso::whereBetween('created_at',[$get_anio_i, $get_anio_f])
            ->orderBy('created_at', 'ASC')->get();
            return $tipoUser;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //print_r(Auth::user()->id);

        $remision = new Remision();
        $motivo = new Motivo();
        $tipoMotivo = new Tipo_motivo();
        $tipoDelito = new Tipo_delito();
        $contacto = new Contacto();
        $registro_caso = new Registro_caso();
        $Caso_involucrado = new Caso_involucrado();
        

        //print_r(count($request["involucrado.rol"]));

        //si todos vienen vacios****************************************************************************
        if ($request->nombre_remision_input == null &&
            $request->nombre_TipoMotivo_input == null &&
            $request->id_delito_input == null
        ) {
            $remision->nombre = $request->remitir_aInput;
            $remision->save();

            $tipoMotivo->nombre = $request->TmotivoInput;
            $tipoMotivo->save();

            $tipoDelito->nombre = $request->tipo_delitoInput;
            $tipoDelito->save();

            $motivo->id_ciudad = $request->ciudad_motivo;
            $motivo->id_tipo_motivo = $tipoMotivo->id;
            $motivo->id_tipo_delito = $tipoDelito->id;
            $motivo->save();

            $registro_caso->id_user = Auth::user()->id;
            $registro_caso->id_motivo = $motivo->id;
            $registro_caso->estado = $request->estado;
            $registro_caso->id_remision = $remision->id;
            $registro_caso->save();

            for ($i=0; $i < count($request["involucrado.rol"]) ; $i++) { 
                $involucrado = new Involucrado();

                $involucrado->rol =isset( $request['involucrado.rol.' . $i])?$request['involucrado.rol.' . $i]:'';
                $involucrado->nombre = isset($request['involucrado.np.' . $i])?$request['involucrado.np.' . $i]:'';
                $involucrado->id_pais = isset($request['involucrado.pais_origen.' . $i])?$request['involucrado.pais_origen.' . $i]:'';
                $involucrado->fecha_nacimiento = isset($request['involucrado.fecha_nacimiento.' . $i])?$request['involucrado.fecha_nacimiento.' . $i]:'';
                $involucrado->genero = isset($request['involucrado.genero.' . $i])?$request['involucrado.genero.' . $i]:'';
                $involucrado->enfoque_diferencial = isset($request['involucrado.comunidad.' . $i])?$request['involucrado.comunidad.' . $i]:'';
                $involucrado->estado_civil = isset($request['involucrado.estado_civil.' . $i])?$request['involucrado.estado_civil.' . $i]:'';
                $involucrado->grado_escolaridad = isset($request['involucrado.grado_esco.' . $i])?$request['involucrado.grado_esco.' . $i]:'';
                $involucrado->salud_empresa = isset($request['involucrado.emp_s.' . $i])?$request['involucrado.emp_s.' . $i]:'';
                $involucrado->tipo_documento = isset($request['involucrado.doc_id.' . $i])?$request['involucrado.doc_id.' . $i]:'';
                $involucrado->no_documento = isset($request['involucrado.documento.' . $i])?$request['involucrado.documento.' . $i]:'';
                $involucrado->fecha_exp_documento = isset($request['involucrado.fecha_expe.' . $i])?$request['involucrado.fecha_expe.' . $i]:'';
                $involucrado->estrato = isset($request['involucrado.estrato.' . $i])?$request['involucrado.estrato.' . $i]:'';
                $involucrado->correo = isset($request['involucrado.correo.' . $i])?$request['involucrado.correo.' . $i]:'';
                $involucrado->id_ciudad_contacto = isset($request['involucrado.ciudad_hecho_con.' . $i])?$request['involucrado.ciudad_hecho_con.' . $i]:'';
                $involucrado->direccion_contacto = isset($request['involucrado.comu_barrio.' . $i])?$request['involucrado.comu_barrio.' . $i]:'';
                $involucrado->id_registro_caso = $registro_caso->id;
                $involucrado->save();
            }

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
                $citacion->id_registro_caso = $registro_caso->id;
                $citacion->save();

            } else if ($request->lugar_cita != null) {
                $citacion = new Citacion();

                $citacion->observacion = $request->observaciones;
                $citacion->fecha = $request->fecha_cita;
                $citacion->hora_inicio = $request->hora_cita;
                $citacion->id_lugar = $request->lugar_cita;
                $citacion->duracion = $request->duracion_cita;
                $citacion->tiempo = $request->tiempo_cita;
                $citacion->id_registro_caso = $registro_caso->id;
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
        

        //si todos vienen llenos***************************************************************************************************
        if($request->nombre_remision_input != null &&
            $request->nombre_TipoMotivo_input != null &&
            $request->id_delito_input != null){

                // $remision->nombre = $request->remitir_aInput;
                // $remision->save();
    
                // $tipoMotivo->nombre = $request->TmotivoInput;
                // $tipoMotivo->save();
    
                // $tipoDelito->nombre = $request->tipo_delitoInput;
                // $tipoDelito->save();
    
                $motivo->id_ciudad = $request->ciudad_motivo;
                $motivo->id_tipo_motivo = $request->nombre_TipoMotivo_input;
                $motivo->id_tipo_delito = $request->id_delito_input;
                $motivo->save();
    
                $registro_caso->id_user = Auth::user()->id;
                $registro_caso->id_motivo = $motivo->id;
                $registro_caso->estado = $request->estado;
                $registro_caso->id_remision = $request->nombre_remision_input;
                $registro_caso->save();
    
                for ($i=0; $i < count($request["involucrado.rol"]) ; $i++) { 
                    $involucrado = new Involucrado();
    
                    $involucrado->rol =isset( $request['involucrado.rol.' . $i])?$request['involucrado.rol.' . $i]:'';
                    $involucrado->nombre = isset($request['involucrado.np.' . $i])?$request['involucrado.np.' . $i]:'';
                    $involucrado->id_pais = isset($request['involucrado.pais_origen.' . $i])?$request['involucrado.pais_origen.' . $i]:'';
                    $involucrado->fecha_nacimiento = isset($request['involucrado.fecha_nacimiento.' . $i])?$request['involucrado.fecha_nacimiento.' . $i]:'';
                    $involucrado->genero = isset($request['involucrado.genero.' . $i])?$request['involucrado.genero.' . $i]:'';
                    $involucrado->enfoque_diferencial = isset($request['involucrado.comunidad.' . $i])?$request['involucrado.comunidad.' . $i]:'';
                    $involucrado->estado_civil = isset($request['involucrado.estado_civil.' . $i])?$request['involucrado.estado_civil.' . $i]:'';
                    $involucrado->grado_escolaridad = isset($request['involucrado.grado_esco.' . $i])?$request['involucrado.grado_esco.' . $i]:'';
                    $involucrado->salud_empresa = isset($request['involucrado.emp_s.' . $i])?$request['involucrado.emp_s.' . $i]:'';
                    $involucrado->tipo_documento = isset($request['involucrado.doc_id.' . $i])?$request['involucrado.doc_id.' . $i]:'';
                    $involucrado->no_documento = isset($request['involucrado.documento.' . $i])?$request['involucrado.documento.' . $i]:'';
                    $involucrado->fecha_exp_documento = isset($request['involucrado.fecha_expe.' . $i])?$request['involucrado.fecha_expe.' . $i]:'';
                    $involucrado->estrato = isset($request['involucrado.estrato.' . $i])?$request['involucrado.estrato.' . $i]:'';
                    $involucrado->correo = isset($request['involucrado.correo.' . $i])?$request['involucrado.correo.' . $i]:'';
                    $involucrado->id_ciudad_contacto = isset($request['involucrado.ciudad_hecho_con.' . $i])?$request['involucrado.ciudad_hecho_con.' . $i]:'';
                    $involucrado->direccion_contacto = isset($request['involucrado.comu_barrio.' . $i])?$request['involucrado.comu_barrio.' . $i]:'';
                    $involucrado->id_registro_caso = $registro_caso->id;
                    $involucrado->save();
                }
    
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
                    $citacion->id_registro_caso = $registro_caso->id;
                    $citacion->save();
    
                } else if ($request->lugar_cita != null) {
                    $citacion = new Citacion();
    
                    $citacion->observacion = $request->observaciones;
                    $citacion->fecha = $request->fecha_cita;
                    $citacion->hora_inicio = $request->hora_cita;
                    $citacion->id_lugar = $request->lugar_cita;
                    $citacion->duracion = $request->duracion_cita;
                    $citacion->tiempo = $request->tiempo_cita;
                    $citacion->id_registro_caso = $registro_caso->id;
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
        
        //si los estremos vienen llenos*******************************************************************************************************
        if ($request->nombre_remision_input != null &&
            $request->nombre_TipoMotivo_input == null &&
            $request->id_delito_input != null
            ) {
             // $remision->nombre = $request->remitir_aInput;
                // $remision->save();
    
                $tipoMotivo->nombre = $request->TmotivoInput;
                $tipoMotivo->save();
    
                // $tipoDelito->nombre = $request->tipo_delitoInput;
                // $tipoDelito->save();
    
                $motivo->id_ciudad = $request->ciudad_motivo;
                $motivo->id_tipo_motivo = $tipoMotivo->id;
                $motivo->id_tipo_delito = $request->id_delito_input;
                $motivo->save();
    
                $registro_caso->id_user = Auth::user()->id;
                $registro_caso->id_motivo = $motivo->id;
                $registro_caso->estado = $request->estado;
                $registro_caso->id_remision = $request->nombre_remision_input;
                $registro_caso->save();
    
                for ($i=0; $i < count($request["involucrado.rol"]) ; $i++) { 
                    $involucrado = new Involucrado();
    
                    $involucrado->rol =isset( $request['involucrado.rol.' . $i])?$request['involucrado.rol.' . $i]:'';
                    $involucrado->nombre = isset($request['involucrado.np.' . $i])?$request['involucrado.np.' . $i]:'';
                    $involucrado->id_pais = isset($request['involucrado.pais_origen.' . $i])?$request['involucrado.pais_origen.' . $i]:'';
                    $involucrado->fecha_nacimiento = isset($request['involucrado.fecha_nacimiento.' . $i])?$request['involucrado.fecha_nacimiento.' . $i]:'';
                    $involucrado->genero = isset($request['involucrado.genero.' . $i])?$request['involucrado.genero.' . $i]:'';
                    $involucrado->enfoque_diferencial = isset($request['involucrado.comunidad.' . $i])?$request['involucrado.comunidad.' . $i]:'';
                    $involucrado->estado_civil = isset($request['involucrado.estado_civil.' . $i])?$request['involucrado.estado_civil.' . $i]:'';
                    $involucrado->grado_escolaridad = isset($request['involucrado.grado_esco.' . $i])?$request['involucrado.grado_esco.' . $i]:'';
                    $involucrado->salud_empresa = isset($request['involucrado.emp_s.' . $i])?$request['involucrado.emp_s.' . $i]:'';
                    $involucrado->tipo_documento = isset($request['involucrado.doc_id.' . $i])?$request['involucrado.doc_id.' . $i]:'';
                    $involucrado->no_documento = isset($request['involucrado.documento.' . $i])?$request['involucrado.documento.' . $i]:'';
                    $involucrado->fecha_exp_documento = isset($request['involucrado.fecha_expe.' . $i])?$request['involucrado.fecha_expe.' . $i]:'';
                    $involucrado->estrato = isset($request['involucrado.estrato.' . $i])?$request['involucrado.estrato.' . $i]:'';
                    $involucrado->correo = isset($request['involucrado.correo.' . $i])?$request['involucrado.correo.' . $i]:'';
                    $involucrado->id_ciudad_contacto = isset($request['involucrado.ciudad_hecho_con.' . $i])?$request['involucrado.ciudad_hecho_con.' . $i]:'';
                    $involucrado->direccion_contacto = isset($request['involucrado.comu_barrio.' . $i])?$request['involucrado.comu_barrio.' . $i]:'';
                    $involucrado->id_registro_caso = $registro_caso->id;
                    $involucrado->save();
                }
    
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
                    $citacion->id_registro_caso = $registro_caso->id;
                    $citacion->save();
    
                } else if ($request->lugar_cita != null) {
                    $citacion = new Citacion();
    
                    $citacion->observacion = $request->observaciones;
                    $citacion->fecha = $request->fecha_cita;
                    $citacion->hora_inicio = $request->hora_cita;
                    $citacion->id_lugar = $request->lugar_cita;
                    $citacion->duracion = $request->duracion_cita;
                    $citacion->tiempo = $request->tiempo_cita;
                    $citacion->id_registro_caso = $registro_caso->id;
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

        //si el primero viene lleno***************************************************************************************************
        if ($request->nombre_remision_input != null &&
            $request->nombre_TipoMotivo_input == null &&
            $request->id_delito_input == null
            ) {
            // $remision->nombre = $request->remitir_aInput;
                // $remision->save();
    
                $tipoMotivo->nombre = $request->TmotivoInput;
                $tipoMotivo->save();
    
                $tipoDelito->nombre = $request->tipo_delitoInput;
                $tipoDelito->save();
    
                $motivo->id_ciudad = $request->ciudad_motivo;
                $motivo->id_tipo_motivo = $tipoMotivo->id;
                $motivo->id_tipo_delito = $tipoDelito->id;
                $motivo->save();
    
                $registro_caso->id_user = Auth::user()->id;
                $registro_caso->id_motivo = $motivo->id;
                $registro_caso->estado = $request->estado;
                $registro_caso->id_remision = $request->nombre_remision_input;
                $registro_caso->save();
    
                for ($i=0; $i < count($request["involucrado.rol"]) ; $i++) { 
                    $involucrado = new Involucrado();
    
                    $involucrado->rol =isset( $request['involucrado.rol.' . $i])?$request['involucrado.rol.' . $i]:'';
                    $involucrado->nombre = isset($request['involucrado.np.' . $i])?$request['involucrado.np.' . $i]:'';
                    $involucrado->id_pais = isset($request['involucrado.pais_origen.' . $i])?$request['involucrado.pais_origen.' . $i]:'';
                    $involucrado->fecha_nacimiento = isset($request['involucrado.fecha_nacimiento.' . $i])?$request['involucrado.fecha_nacimiento.' . $i]:'';
                    $involucrado->genero = isset($request['involucrado.genero.' . $i])?$request['involucrado.genero.' . $i]:'';
                    $involucrado->enfoque_diferencial = isset($request['involucrado.comunidad.' . $i])?$request['involucrado.comunidad.' . $i]:'';
                    $involucrado->estado_civil = isset($request['involucrado.estado_civil.' . $i])?$request['involucrado.estado_civil.' . $i]:'';
                    $involucrado->grado_escolaridad = isset($request['involucrado.grado_esco.' . $i])?$request['involucrado.grado_esco.' . $i]:'';
                    $involucrado->salud_empresa = isset($request['involucrado.emp_s.' . $i])?$request['involucrado.emp_s.' . $i]:'';
                    $involucrado->tipo_documento = isset($request['involucrado.doc_id.' . $i])?$request['involucrado.doc_id.' . $i]:'';
                    $involucrado->no_documento = isset($request['involucrado.documento.' . $i])?$request['involucrado.documento.' . $i]:'';
                    $involucrado->fecha_exp_documento = isset($request['involucrado.fecha_expe.' . $i])?$request['involucrado.fecha_expe.' . $i]:'';
                    $involucrado->estrato = isset($request['involucrado.estrato.' . $i])?$request['involucrado.estrato.' . $i]:'';
                    $involucrado->correo = isset($request['involucrado.correo.' . $i])?$request['involucrado.correo.' . $i]:'';
                    $involucrado->id_ciudad_contacto = isset($request['involucrado.ciudad_hecho_con.' . $i])?$request['involucrado.ciudad_hecho_con.' . $i]:'';
                    $involucrado->direccion_contacto = isset($request['involucrado.comu_barrio.' . $i])?$request['involucrado.comu_barrio.' . $i]:'';
                    $involucrado->id_registro_caso = $registro_caso->id;
                    $involucrado->save();
                }
    
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
                    $citacion->id_registro_caso = $registro_caso->id;
                    $citacion->save();
    
                } else if ($request->lugar_cita != null) {
                    $citacion = new Citacion();
    
                    $citacion->observacion = $request->observaciones;
                    $citacion->fecha = $request->fecha_cita;
                    $citacion->hora_inicio = $request->hora_cita;
                    $citacion->id_lugar = $request->lugar_cita;
                    $citacion->duracion = $request->duracion_cita;
                    $citacion->tiempo = $request->tiempo_cita;
                    $citacion->id_registro_caso = $registro_caso->id;
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

        //si el ultimo viene lleno************************************************************************************************************
        if ($request->nombre_remision_input == null &&
            $request->nombre_TipoMotivo_input == null &&
            $request->id_delito_input != null
        ) {
                $remision->nombre = $request->remitir_aInput;
                $remision->save();
    
                $tipoMotivo->nombre = $request->TmotivoInput;
                $tipoMotivo->save();
    
                // $tipoDelito->nombre = $request->tipo_delitoInput;
                // $tipoDelito->save();
    
                $motivo->id_ciudad = $request->ciudad_motivo;
                $motivo->id_tipo_motivo = $tipoMotivo->id;
                $motivo->id_tipo_delito = $request->id_delito_input;
                $motivo->save();
    
                $registro_caso->id_user = Auth::user()->id;
                $registro_caso->id_motivo = $motivo->id;
                $registro_caso->estado = $request->estado;
                $registro_caso->id_remision = $remision->id;
                $registro_caso->save();
    
                for ($i=0; $i < count($request["involucrado.rol"]) ; $i++) { 
                    $involucrado = new Involucrado();
    
                    $involucrado->rol =isset( $request['involucrado.rol.' . $i])?$request['involucrado.rol.' . $i]:'';
                    $involucrado->nombre = isset($request['involucrado.np.' . $i])?$request['involucrado.np.' . $i]:'';
                    $involucrado->id_pais = isset($request['involucrado.pais_origen.' . $i])?$request['involucrado.pais_origen.' . $i]:'';
                    $involucrado->fecha_nacimiento = isset($request['involucrado.fecha_nacimiento.' . $i])?$request['involucrado.fecha_nacimiento.' . $i]:'';
                    $involucrado->genero = isset($request['involucrado.genero.' . $i])?$request['involucrado.genero.' . $i]:'';
                    $involucrado->enfoque_diferencial = isset($request['involucrado.comunidad.' . $i])?$request['involucrado.comunidad.' . $i]:'';
                    $involucrado->estado_civil = isset($request['involucrado.estado_civil.' . $i])?$request['involucrado.estado_civil.' . $i]:'';
                    $involucrado->grado_escolaridad = isset($request['involucrado.grado_esco.' . $i])?$request['involucrado.grado_esco.' . $i]:'';
                    $involucrado->salud_empresa = isset($request['involucrado.emp_s.' . $i])?$request['involucrado.emp_s.' . $i]:'';
                    $involucrado->tipo_documento = isset($request['involucrado.doc_id.' . $i])?$request['involucrado.doc_id.' . $i]:'';
                    $involucrado->no_documento = isset($request['involucrado.documento.' . $i])?$request['involucrado.documento.' . $i]:'';
                    $involucrado->fecha_exp_documento = isset($request['involucrado.fecha_expe.' . $i])?$request['involucrado.fecha_expe.' . $i]:'';
                    $involucrado->estrato = isset($request['involucrado.estrato.' . $i])?$request['involucrado.estrato.' . $i]:'';
                    $involucrado->correo = isset($request['involucrado.correo.' . $i])?$request['involucrado.correo.' . $i]:'';
                    $involucrado->id_ciudad_contacto = isset($request['involucrado.ciudad_hecho_con.' . $i])?$request['involucrado.ciudad_hecho_con.' . $i]:'';
                    $involucrado->direccion_contacto = isset($request['involucrado.comu_barrio.' . $i])?$request['involucrado.comu_barrio.' . $i]:'';
                    $involucrado->id_registro_caso = $registro_caso->id;
                    $involucrado->save();
                }
    
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
                    $citacion->id_registro_caso = $registro_caso->id;
                    $citacion->save();
    
                } else if ($request->lugar_cita != null) {
                    $citacion = new Citacion();
    
                    $citacion->observacion = $request->observaciones;
                    $citacion->fecha = $request->fecha_cita;
                    $citacion->hora_inicio = $request->hora_cita;
                    $citacion->id_lugar = $request->lugar_cita;
                    $citacion->duracion = $request->duracion_cita;
                    $citacion->tiempo = $request->tiempo_cita;
                    $citacion->id_registro_caso = $registro_caso->id;
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

        //si los dos primeros vienen llenos
        if ($request->nombre_remision_input != null &&
            $request->nombre_TipoMotivo_input != null &&
            $request->id_delito_input == null
        ) {
            // $remision->nombre = $request->remitir_aInput;
            // $remision->save();

            // $tipoMotivo->nombre = $request->TmotivoInput;
            // $tipoMotivo->save();

            $tipoDelito->nombre = $request->tipo_delitoInput;
            $tipoDelito->save();

            $motivo->id_ciudad = $request->ciudad_motivo;
            $motivo->id_tipo_motivo = $request->nombre_TipoMotivo_input;
            $motivo->id_tipo_delito = $tipoDelito->id;
            $motivo->save();

            $registro_caso->id_user = Auth::user()->id;
            $registro_caso->id_motivo = $motivo->id;
            $registro_caso->estado = $request->estado;
            $registro_caso->id_remision = $request->nombre_remision_input;
            $registro_caso->save();

            for ($i=0; $i < count($request["involucrado.rol"]) ; $i++) { 
                $involucrado = new Involucrado();

                $involucrado->rol =isset( $request['involucrado.rol.' . $i])?$request['involucrado.rol.' . $i]:'';
                $involucrado->nombre = isset($request['involucrado.np.' . $i])?$request['involucrado.np.' . $i]:'';
                $involucrado->id_pais = isset($request['involucrado.pais_origen.' . $i])?$request['involucrado.pais_origen.' . $i]:'';
                $involucrado->fecha_nacimiento = isset($request['involucrado.fecha_nacimiento.' . $i])?$request['involucrado.fecha_nacimiento.' . $i]:'';
                $involucrado->genero = isset($request['involucrado.genero.' . $i])?$request['involucrado.genero.' . $i]:'';
                $involucrado->enfoque_diferencial = isset($request['involucrado.comunidad.' . $i])?$request['involucrado.comunidad.' . $i]:'';
                $involucrado->estado_civil = isset($request['involucrado.estado_civil.' . $i])?$request['involucrado.estado_civil.' . $i]:'';
                $involucrado->grado_escolaridad = isset($request['involucrado.grado_esco.' . $i])?$request['involucrado.grado_esco.' . $i]:'';
                $involucrado->salud_empresa = isset($request['involucrado.emp_s.' . $i])?$request['involucrado.emp_s.' . $i]:'';
                $involucrado->tipo_documento = isset($request['involucrado.doc_id.' . $i])?$request['involucrado.doc_id.' . $i]:'';
                $involucrado->no_documento = isset($request['involucrado.documento.' . $i])?$request['involucrado.documento.' . $i]:'';
                $involucrado->fecha_exp_documento = isset($request['involucrado.fecha_expe.' . $i])?$request['involucrado.fecha_expe.' . $i]:'';
                $involucrado->estrato = isset($request['involucrado.estrato.' . $i])?$request['involucrado.estrato.' . $i]:'';
                $involucrado->correo = isset($request['involucrado.correo.' . $i])?$request['involucrado.correo.' . $i]:'';
                $involucrado->id_ciudad_contacto = isset($request['involucrado.ciudad_hecho_con.' . $i])?$request['involucrado.ciudad_hecho_con.' . $i]:'';
                $involucrado->direccion_contacto = isset($request['involucrado.comu_barrio.' . $i])?$request['involucrado.comu_barrio.' . $i]:'';
                $involucrado->id_registro_caso = $registro_caso->id;
                $involucrado->save();
            }

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
                $citacion->id_registro_caso = $registro_caso->id;
                $citacion->save();

            } else if ($request->lugar_cita != null) {
                $citacion = new Citacion();

                $citacion->observacion = $request->observaciones;
                $citacion->fecha = $request->fecha_cita;
                $citacion->hora_inicio = $request->hora_cita;
                $citacion->id_lugar = $request->lugar_cita;
                $citacion->duracion = $request->duracion_cita;
                $citacion->tiempo = $request->tiempo_cita;
                $citacion->id_registro_caso = $registro_caso->id;
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

        //si los dos ultimos vienen llenos*******************************************************************************************************
        if ($request->nombre_remision_input == null &&
            $request->nombre_TipoMotivo_input != null &&
            $request->id_delito_input != null
        ) {
            $remision->nombre = $request->remitir_aInput;
            $remision->save();

            // $tipoMotivo->nombre = $request->TmotivoInput;
            // $tipoMotivo->save();

            // $tipoDelito->nombre = $request->tipo_delitoInput;
            // $tipoDelito->save();

            $motivo->id_ciudad = $request->ciudad_motivo;
            $motivo->id_tipo_motivo = $request->nombre_TipoMotivo_input;
            $motivo->id_tipo_delito = $request->id_delito_input;
            $motivo->save();

            $registro_caso->id_user = Auth::user()->id;
            $registro_caso->id_motivo = $motivo->id;
            $registro_caso->estado = $request->estado;
            $registro_caso->id_remision = $remision->id;
            $registro_caso->save();

            for ($i=0; $i < count($request["involucrado.rol"]) ; $i++) { 
                $involucrado = new Involucrado();

                $involucrado->rol =isset( $request['involucrado.rol.' . $i])?$request['involucrado.rol.' . $i]:'';
                $involucrado->nombre = isset($request['involucrado.np.' . $i])?$request['involucrado.np.' . $i]:'';
                $involucrado->id_pais = isset($request['involucrado.pais_origen.' . $i])?$request['involucrado.pais_origen.' . $i]:'';
                $involucrado->fecha_nacimiento = isset($request['involucrado.fecha_nacimiento.' . $i])?$request['involucrado.fecha_nacimiento.' . $i]:'';
                $involucrado->genero = isset($request['involucrado.genero.' . $i])?$request['involucrado.genero.' . $i]:'';
                $involucrado->enfoque_diferencial = isset($request['involucrado.comunidad.' . $i])?$request['involucrado.comunidad.' . $i]:'';
                $involucrado->estado_civil = isset($request['involucrado.estado_civil.' . $i])?$request['involucrado.estado_civil.' . $i]:'';
                $involucrado->grado_escolaridad = isset($request['involucrado.grado_esco.' . $i])?$request['involucrado.grado_esco.' . $i]:'';
                $involucrado->salud_empresa = isset($request['involucrado.emp_s.' . $i])?$request['involucrado.emp_s.' . $i]:'';
                $involucrado->tipo_documento = isset($request['involucrado.doc_id.' . $i])?$request['involucrado.doc_id.' . $i]:'';
                $involucrado->no_documento = isset($request['involucrado.documento.' . $i])?$request['involucrado.documento.' . $i]:'';
                $involucrado->fecha_exp_documento = isset($request['involucrado.fecha_expe.' . $i])?$request['involucrado.fecha_expe.' . $i]:'';
                $involucrado->estrato = isset($request['involucrado.estrato.' . $i])?$request['involucrado.estrato.' . $i]:'';
                $involucrado->correo = isset($request['involucrado.correo.' . $i])?$request['involucrado.correo.' . $i]:'';
                $involucrado->id_ciudad_contacto = isset($request['involucrado.ciudad_hecho_con.' . $i])?$request['involucrado.ciudad_hecho_con.' . $i]:'';
                $involucrado->direccion_contacto = isset($request['involucrado.comu_barrio.' . $i])?$request['involucrado.comu_barrio.' . $i]:'';
                $involucrado->id_registro_caso = $registro_caso->id;
                $involucrado->save();
            }

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
                $citacion->id_registro_caso = $registro_caso->id;
                $citacion->save();

            } else if ($request->lugar_cita != null) {
                $citacion = new Citacion();

                $citacion->observacion = $request->observaciones;
                $citacion->fecha = $request->fecha_cita;
                $citacion->hora_inicio = $request->hora_cita;
                $citacion->id_lugar = $request->lugar_cita;
                $citacion->duracion = $request->duracion_cita;
                $citacion->tiempo = $request->tiempo_cita;
                $citacion->id_registro_caso = $registro_caso->id;
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

        //si el de la mitad viene lleno
        if ($request->nombre_remision_input == null &&
            $request->nombre_TipoMotivo_input != null &&
            $request->id_delito_input == null
        ) {
            $remision->nombre = $request->remitir_aInput;
            $remision->save();

            // $tipoMotivo->nombre = $request->TmotivoInput;
            // $tipoMotivo->save();

            $tipoDelito->nombre = $request->tipo_delitoInput;
            $tipoDelito->save();

            $motivo->id_ciudad = $request->ciudad_motivo;
            $motivo->id_tipo_motivo = $request->nombre_TipoMotivo_input;
            $motivo->id_tipo_delito = $tipoDelito->id;
            $motivo->save();

            $registro_caso->id_user = Auth::user()->id;
            $registro_caso->id_motivo = $motivo->id;
            $registro_caso->estado = $request->estado;
            $registro_caso->id_remision = $remision->id;
            $registro_caso->save();

            for ($i=0; $i < count($request["involucrado.rol"]) ; $i++) { 
                $involucrado = new Involucrado();

                $involucrado->rol =isset( $request['involucrado.rol.' . $i])?$request['involucrado.rol.' . $i]:'';
                $involucrado->nombre = isset($request['involucrado.np.' . $i])?$request['involucrado.np.' . $i]:'';
                $involucrado->id_pais = isset($request['involucrado.pais_origen.' . $i])?$request['involucrado.pais_origen.' . $i]:'';
                $involucrado->fecha_nacimiento = isset($request['involucrado.fecha_nacimiento.' . $i])?$request['involucrado.fecha_nacimiento.' . $i]:'';
                $involucrado->genero = isset($request['involucrado.genero.' . $i])?$request['involucrado.genero.' . $i]:'';
                $involucrado->enfoque_diferencial = isset($request['involucrado.comunidad.' . $i])?$request['involucrado.comunidad.' . $i]:'';
                $involucrado->estado_civil = isset($request['involucrado.estado_civil.' . $i])?$request['involucrado.estado_civil.' . $i]:'';
                $involucrado->grado_escolaridad = isset($request['involucrado.grado_esco.' . $i])?$request['involucrado.grado_esco.' . $i]:'';
                $involucrado->salud_empresa = isset($request['involucrado.emp_s.' . $i])?$request['involucrado.emp_s.' . $i]:'';
                $involucrado->tipo_documento = isset($request['involucrado.doc_id.' . $i])?$request['involucrado.doc_id.' . $i]:'';
                $involucrado->no_documento = isset($request['involucrado.documento.' . $i])?$request['involucrado.documento.' . $i]:'';
                $involucrado->fecha_exp_documento = isset($request['involucrado.fecha_expe.' . $i])?$request['involucrado.fecha_expe.' . $i]:'';
                $involucrado->estrato = isset($request['involucrado.estrato.' . $i])?$request['involucrado.estrato.' . $i]:'';
                $involucrado->correo = isset($request['involucrado.correo.' . $i])?$request['involucrado.correo.' . $i]:'';
                $involucrado->id_ciudad_contacto = isset($request['involucrado.ciudad_hecho_con.' . $i])?$request['involucrado.ciudad_hecho_con.' . $i]:'';
                $involucrado->direccion_contacto = isset($request['involucrado.comu_barrio.' . $i])?$request['involucrado.comu_barrio.' . $i]:'';
                $involucrado->id_registro_caso = $registro_caso->id;
                $involucrado->save();
            }

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
                $citacion->id_registro_caso = $registro_caso->id;
                $citacion->save();

            } else if ($request->lugar_cita != null) {
                $citacion = new Citacion();

                $citacion->observacion = $request->observaciones;
                $citacion->fecha = $request->fecha_cita;
                $citacion->hora_inicio = $request->hora_cita;
                $citacion->id_lugar = $request->lugar_cita;
                $citacion->duracion = $request->duracion_cita;
                $citacion->tiempo = $request->tiempo_cita;
                $citacion->id_registro_caso = $registro_caso->id;
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registro_caso  $registro_caso
     * @return \Illuminate\Http\Response
     */
    public function show(Registro_caso $registro_caso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registro_caso  $registro_caso
     * @return \Illuminate\Http\Response
     */
    public function edit(Registro_caso $registro_caso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registro_caso  $registro_caso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registro_caso $registro_caso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registro_caso  $registro_caso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registro_caso $registro_caso)
    {
        //
    }
}
