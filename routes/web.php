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
 Route::get('/reportesC', function () {
     return view('home');
 })->middleware('auth');
 Route::get('/reportes', function () {
     return view('home');
 })->middleware('auth');
 Route::get('/Casos', function () {
     return view('home');
 })->middleware('auth');

Route::resource('user','UserController')->middleware('auth');
Route::resource('tipoUsuario','TipoUsuarioController')->middleware('auth');
Route::resource('solicitudRgistro','RegistroSolicitudController')->middleware('auth');
Route::resource('delito','RegistroDelitoController')->middleware('auth');
Route::post('get_delito','RegistroDelitoController@reportes')->middleware('auth');
Route::post('get_delito_mes','RegistroDelitoController@mes_reportes')->middleware('auth');
Route::post('reportes_mc_mes','RegistroDelitoController@reportes_mc_mes')->middleware('auth');
Route::post('reportes_mp_mes','RegistroDelitoController@reportes_mp_mes')->middleware('auth');
Route::post('reporte_delito','RegistroCasoController@reportes')->middleware('auth');
Route::post('reportes_mc_anio','RegistroDelitoController@reportes_mc_anio')->middleware('auth');
Route::post('reportes_mp_anio','RegistroDelitoController@reportes_mp_anio')->middleware('auth');
Route::resource('medidac','RegistroMcController')->middleware('auth');
Route::resource('medidap','RegistroMpController')->middleware('auth');
Route::resource('solicitante','SolicitanteController')->middleware('auth');
Route::get('tipo_usuario','UserController@view')->middleware('auth');

Route::resource('lugar','LugarController')->middleware('auth');
Route::get('motivo','RegistroCasoController@motivo')->middleware('auth');
// Route::post('newsolicitante','RegistroSolicitudController@solicitante')->middleware('auth');
// Route::resource('remision','RemisionController')->middleware('auth');
Route::resource('tDelito','TipoDelitoController')->middleware('auth');
Route::resource('tipo_motivo','TipoMotivoController')->middleware('auth');
Route::resource('registro_caso','RegistroCasoController')->middleware('auth');
Route::post('reporte_caso_conciliado','RegistroCasoController@conciliados')->middleware('auth');
Route::post('reporte_caso_desacuerdo','RegistroCasoController@no_acuerdo')->middleware('auth');
Route::post('reporte_caso_resuelto','RegistroCasoController@resuelto')->middleware('auth');
Route::post('reporte_caso_remitido','RegistroCasoController@remitido')->middleware('auth');
Route::post('reporte_caso_anio','RegistroCasoController@reportes_anio')->middleware('auth');
Route::get('involucrado','RegistroCasoController@involucrado')->middleware('auth');
Route::get('remision','RegistroCasoController@remision')->middleware('auth');
Route::resource('citas','CitacionController')->middleware('auth');
Route::resource('cte','ConvocanteController')->middleware('auth');
Route::resource('cdo','ConvocadosController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('usuario','UserController')->middleware('auth');  

Route::get('pais','PaisController@index')->middleware('auth');
Route::get('depto','DepartamentoController@index')->middleware('auth');
Route::get('ciudad','CiudadController@index')->middleware('auth');

