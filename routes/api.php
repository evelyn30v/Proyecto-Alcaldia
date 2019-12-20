<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::group(['middleware' => 'auth'], function() {
//     Route::get('/latest', 'InternalApiController@latest');
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('usuario','UserController')->middleware('auth');    
Route::resource('tipoUsuario','TipoUsuarioController')->middleware('auth');
Route::resource('solicitudRgistro','RegistroSolicitudController');
Route::resource('delito','RegistroDelitoController')->middleware('auth');
Route::resource('medidac','RegistroMcController')->middleware('auth');
Route::resource('medidap','RegistroMpController')->middleware('auth');
Route::get('solicitante','RegistroSolicitudController@view')->middleware('auth');
Route::get('tipo_usuario','UserController@view')->middleware('auth');
Route::post('newsolicitante','RegistroSolicitudController@solicitante')->middleware('auth');
Route::resource('remision','RemisionController')->middleware('auth');
Route::resource('tDelito','TipoDelitoController')->middleware('auth');
Route::resource('tipo_motivo','TipoMotivoController')->middleware('auth');
Route::resource('registro_caso','RegistroCasoController')->middleware('auth');
Route::get('lugar','LugarController@index')->middleware('auth');

Route::get('pais','PaisController@index')->middleware('auth');
Route::get('depto','DepartamentoController@index')->middleware('auth');
Route::get('ciudad','CiudadController@index')->middleware('auth');



