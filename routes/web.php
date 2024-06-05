<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirmaSoftwareSouls;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IntranetController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UnidadesMController;
use App\Http\Controllers\ubicacionesController;
use App\Http\Controllers\navbarController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MaterialAlmacenController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Romovi');
});
// Esta función se ejecutará cada vez que se solicite una vista
Route::get('/navbar',[navbarController::class,'navbar'])->name('navbar');
//Firma

Route::get('/FirmaSoftwareSouls',[FirmaSoftwareSouls::class,'FirmaSoftwareSouls']);


//Mail

Route::post('/Email',[MailController::class, 'sendEmail'])->name('send.email');

//Login

Route::get('/Login',[LoginController::class, 'Login'])->name('Login');
Route::post('/IniciarSesion',[LoginController::class,'IniciarSesion'])->name('IniciarSesion');

//Intranet

Route::get('/dashboard',[IntranetController::class,'dashboard'])->name('dashboard')->middleware('auth');



//Usuarios 

Route::get('/Usuarios', [UsuarioController::class,'Usuarios'])->name('Usuarios')->middleware('auth');
Route::get('/CrearUsuario',[UsuarioController::class,'CrearUsuario'])->name('CrearUsuario')->middleware('auth');
Route::post('/RegistrarUsuario',[UsuarioController::class,'RegistrarUsuario'])->name('RegistrarUsuario')->middleware('auth');
Route::get('/eliminarUsuario/{id}', [UsuarioController::class, 'eliminarUsuario'])->name('eliminarUsuario')->middleware('auth');
Route::get('/examinarUsuario/{id}',[UsuarioController::class,'examinarUsuario'])->name('examinarUsuario')->middleware('auth');
Route::put('/modificarUsuario/{id}',[UsuarioController::class,'modificarUsuario'])->name('modificarUsuario')->middleware('auth');

//unidadesMedidas

Route::get('/unidadesMedidas',[UnidadesMController::class,'unidadesMedidas'])->name('unidadadesMedidas')->middleware('auth');
Route::get('/CrearUnidadMedida',[UnidadesMController::class,'CrearUnidadMedida'])->name('CrearUnidadMedida')->middleware('auth');
Route::post('/RegistrarUnidadMedida',[UnidadesMController::class,'RegistrarUnidadMedida'])->name('RegistrarUnidadMedida')->middleware('auth');
Route::get('/eliminarUnidadMedida/{id}',[UnidadesMController::class,'eliminarUnidadMedida'])->name('eliminarUnidadMedida')->middleware('auth');
Route::get('/exanimarMedida/{id}',[UnidadesMController::class,'exanimarMedida'])->name('exanimarMedida')->middleware('auth');
Route::put('/modificarUnidadMedida/{id}',[UnidadesMController::class,'modificarUnidadMedida'])->name('modificarUnidadMedida')->middleware('auth');

//Ubicaciones

Route::get('/ubicaciones',[ubicacionesController::class,'ubicaciones'])->name('ubicaciones')->middleware('auth');
Route::get('/CrearUbicacion',[ubicacionesController::class,'CrearUbicacion'])->name('CrearUbicacion')->middleware('auth');
Route::post('/RegistrarUbicacion',[ubicacionesController::class,'RegistrarUbicacion'])->name('RegistrarUbicacion')->middleware('auth');
Route::get('/eliminarUbicacion/{id}',[ubicacionesController::class,'eliminarUbicacion'])->name('eliminarUbicacion')->middleware('auth');
Route::get('/examinarUbicacion/{id}',[ubicacionesController::class,'examinarUbicacion'])->name('examinarUbicacion')->middleware('auth');
Route::put('/modificarUbicacion/{id}',[ubicacionesController::class,'modificarUbicacion'])->name('modificarUbicacion')->middleware('auth');

//Almacenes

Route::get('/Almacenes',[AlmacenController::class,'Almacenes'])->name('Almacenes')->middleware('auth');
Route::get('/CrearAlmacen',[AlmacenController::class,'CrearAlmacen'])->name('CrearAlmacen')->middleware('auth');
Route::post('/RegistrarAlmacen',[AlmacenController::class,'RegistrarAlmacen'])->name('RegistrarAlmacen')->middleware('auth');
Route::get('/eliminarAlmacen/{id}',[AlmacenController::class,'eliminarAlmacen'])->name('eliminarAlmacen')->middleware('auth');
Route::get('/examinarAlmacen/{id}',[AlmacenController::class,'examinarAlmacen'])->name('examinarAlmacen')->middleware('auth');
Route::put('/modificarAlmacen/{id}',[AlmacenController::class,'modificarAlmacen'])->name('modificarAlmacen')->middleware('auth');


//Control de materiales
Route::get('/Materiales',[MaterialController::class,'Materiales'])->name('Materiales')->middleware('auth');
Route::get('/CrearMaterial',[MaterialController::class,'CrearMaterial'])->name('CrearMaterial')->middleware('auth');
Route::post('/RegistrarMaterial',[MaterialController::class,'RegistrarMaterial'])->name('RegistrarMaterial')->middleware('auth');
Route::get('/eliminarMaterial/{id}',[MaterialController::class,'eliminarMaterial'])->name('eliminarMaterial')->middleware('auth');
Route::get('/examinarMaterial/{id}',[MaterialController::class,'examinarMaterial'])->name('examinarMaterial')->middleware('auth');
Route::put('/modificarMaterial/{id}',[MaterialController::class,'modificarMaterial'])->name('modificarMaterial')->middleware('auth');
Route::post('/Buscarmateriales',[MaterialController::class,'Buscarmateriales'])->name('Buscarmateriales')->middleware('auth');


//MaterialAlmacen
Route::get('/MaterialAlmacen/{id}',[MaterialAlmacenController::class,'MaterialAlmacen'])->name('MaterialAlmacen')->middleware('auth');
Route::get('/crearMaterialAlmacen/{id}',[MaterialAlmacenController::class,'crearMaterialAlmacen'])->name('crearMaterialAlmacen')->middleware('auth');
Route::post('/registrarMaterialAlmacen/{id}',[MaterialAlmacenController::class,'registrarMaterialAlmacen'])->name('registrarMaterialAlmacen')->middleware('auth');
Route::get('/eliminarMaterialAlmacen/{id}/{id2}',[MaterialAlmacenController::class,'eliminarMaterialAlmacen'])->name('eliminarMaterialAlmacen')->middleware('auth');
Route::get('/examinarMaterialAlmacen/{id}/{id2}',[MaterialAlmacenController::class,'examinarMaterialAlmacen'])->name('examinarMaterialAlmacen')->middleware('auth');
Route::put('/modificarMaterialAlmacen/{id}/{id2}', [MaterialAlmacenController::class, 'modificarMaterialAlmacen'])->name('modificarMaterialAlmacen')->middleware('auth');
Route::post('/buscarMaterialAlmacen/{id}',[MaterialAlmacenController::class,'buscarMaterialAlmacen'])->name('buscarMaterialAlmacen')->middleware('auth');


//Entradas
Route::get('/Entradas/{id}',[EntradaController::class,'Entradas'])->name('Entradas')->middleware('auth');
Route::get('/CrearEntrada/{id}',[EntradaController::class,'CrearEntrada'])->name('CrearEntrada')->middleware('auth');
Route::post('/registrarEntrada/{id}',[EntradaController::class,'registrarEntrada'])->name('registrarEntrada')->middleware('auth');
Route::get('/eliminarEntrada/{id}/{id2}',[EntradaController::class,'eliminarEntrada'])->name('eliminarEntrada')->middleware('auth');
Route::get('/obtenerMateriales/{id}', [EntradaController::class, 'obtenerMateriales'])->name('obtenerMateriales')->middleware('auth');


//Salidas
Route::get('/Salidas/{id}',[SalidaController::class,'Salidas'])->name('Salidas')->middleware('auth');
Route::get('/CrearSalida/{id}',[SalidaController::class,'CrearSalida'])->name('CrearSalida')->middleware('auth');
Route::post('/RegistrarSalida/{id}',[SalidaController::class,'RegistrarSalida'])->name('RegistrarSalida')->middleware('auth');
Route::get('/eliminarSalida/{id}/{id2}',[SalidaController::class,'eliminarSalida'])->name('eliminarSalida')->middleware('auth');
Route::get('/obtenerSumaCantidad/{id}',[SalidaController::class,'obtenerSumaCantidad'])->name('obtenerSumaCantidad')->middleware('auth');