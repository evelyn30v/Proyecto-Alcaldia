<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('auth/login');
});
Route::get('/RegistrosAdmin', function () {
     return view('home');
 })->middleware('auth');
Route::get('/RegistroUsuario', function () {
     return view('home');
 })->middleware('auth');

 Route::get('/NuevaDependencia', function () {
     return view('home');
 })->middleware('auth');
 Route::get('/registro_solic', function () {
     return view('home');
 })->middleware('auth');
 Route::get('/Solicitudes', function () {
     return view('home');
 })->middleware('auth');
 Route::get('/usuarios', function () {
     return view('home');
 })->middleware('auth');
 Route::get('/registro_caso', function () {
     return view('home');
 })->middleware('auth');
 Route::get('/dependencia', function () {
     return view('home');
 })->middleware('auth');
 Route::get('/RegistroDelitos', function () {
     return view('home');
 })->middleware('auth');
 Route::get('/RegistroMc', function () {
     return view('home');
 })->middleware('auth');
 Route::get('/RegistroMp', function () {
     return view('home');
 })->middleware('auth');
 Route::get('/registroCaso', function () {
     return view('home');
 })->middleware('auth');

Route::resource('user','UserController')->middleware('auth');
Route::resource('tipoUsuario','TipoUsuarioController')->middleware('auth');
Route::resource('solicitudRgistro','RegistroSolicitudController')->middleware('auth');
Route::resource('delito','RegistroDelitoController')->middleware('auth');
Route::resource('medidac','RegistroMcController')->middleware('auth');
Route::resource('medidap','RegistroMpController')->middleware('auth');
Route::get('solicitante','RegistroSolicitudController@view')->middleware('auth');
Route::get('tipo_usuario','UserController@view')->middleware('auth');
Route::get('pais','PaisController@index')->middleware('auth');
Route::get('depto','DepartamentoController@index')->middleware('auth');
Route::get('ciudad','CiudadController@index')->middleware('auth');
Route::get('lugar','LugarController@index')->middleware('auth');
Route::post('newsolicitante','RegistroSolicitudController@solicitante')->middleware('auth');
Route::resource('remision','RemisionController')->middleware('auth');
Route::resource('tDelito','TipoDelitoController')->middleware('auth');
Route::resource('tipo_motivo','TipoMotivoController')->middleware('auth');
Route::resource('registro_caso','RegistroCasoController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('usuario','UserController')->middleware('auth');   

