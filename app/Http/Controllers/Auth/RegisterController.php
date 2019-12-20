<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;   
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8'],
        //     'cedula' => ['required','string','min:10'],
        //     'celular' => ['required','string','min:10'],
            
        // ]);
    }


    protected function store(Request $request){

        // $User = new User();

        // $User->perfil = $request->perfil;
        // $User->name = $request->name;
        // $User->apellido = $request->apellido;
        // $User->cedula = $request->cedula;
        // $User->celular = $request->celular;
        // $User->tipo_usuario_id = $request->tipo_usuario_id;
        // $User->email = $request->email;
        // $User->email_verified_at = $request->email_verified_at;
        // $User->password = $request->password;
        // $User->save();

        // return $User;
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        //print_r('hola mundo');
        // return User::create([
        //         'perfil' => $data["perfil"],
        //         'name' =>  $data["nombre"],
        //         'apellido' => $data["apellido"],
        //         'cedula' => $data["cedula"],
        //         'celular' => $data["celular"],
        //         'tipo_usuario_id' => $data['tipo_usuario_id'],
        //         'email' => $data['email'],
        //         'password' => $data['password']
        //       ]);
    }

    public function register(Request $request) {

        $perfil = $request->perfil;
        User::create($request->all()); 
        //print_r($perfil);
        //App\User::create([
        //     'perfil' => $data["perfil"],
        //     'name' =>  $data["nombre"],
        //     'apellido' => $data["apellido"],
        //     'cedula' => $data["cedula"],
        //     'celular' => $data["celular"],
        //     'tipo_usuario_id' => $data['tipo_usuario_id'],
        //     'email' => $data['email'],
        //     'password' => $data['password']
        //   ]);
    

                // $User->perfil = $request->perfil;
                // $User->name = $request->nombre;
                // $User->apellido = $request->apellido;
                // $User->cedula = $request->cedula;
                // $User->celular = $request->celular;
                // $User->tipo_usuario_id = 1;
                // $User->email = $request->email;
                // //$User->email_verified_at = $request->email;
                // $User->password = Hash::make($request->password);
                // $User->save();
    
            // return $User;
    }
}