<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Fecades\Hash;
use App\User;
use App\Tipo_usuario;
use File;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return $users;
    }
    public function view()
    {
        $dependencia = Tipo_usuario::get();
        return $dependencia;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        // $nombre=$request->nombre;
        // print_r($nombre);
 
        // if($request->hasFile('perfil')){
            // $file = $request->file('perfil');
            // $nombre = time().$file;
            // // ->getClientOriginalName()
            // $file->storeAs('perfil/',$nombre);
            // return $nombre;
        
            $User = new User();
            //$User->perfil = $file;
            $User->name = $request->nombre;
            $User->apellido = $request->apellido;
            $User->cedula = $request->cedula;
            $User->celular = $request->celular;
            $User->tipo_usuario_id = $request->tipo_usuario_id;
            $User->email = $request->email;
            //$User->password = ($request->password);
            $User->password = bcrypt($request->password);
            $User->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 
         //User::find($id);
        // $data = $request()->all();
        // $data['password'] = bcrypt($data['password']);
        // $data->update($data);   
        //User::find($id)->update($request->all());
        $User = User::find($id);
            //$User->perfil = $file;
            $User->name = $request->name;
            $User->apellido = $request->apellido;
            $User->cedula = $request->cedula;
            $User->celular = $request->celular;
            $User->tipo_usuario_id = $request->tipo_usuario_id;
            $User->email = $request->email;
            $User->password = bcrypt($request->password);
            $User->save();
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

    }
}
