<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IdiomasController;
use App\Http\Controllers\TematicasController;
use App\Http\Controllers\PreguntasController;
use App\Http\Controllers\EnlacesController;
use App\Http\Controllers\ComenzarController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

//home
Route::get('/', [HomeController::class, 'login'])->name('home.login');
Route::get('/index', [HomeController::class, 'index'])->name('home.index');
Route::get('/register', [HomeController::class, 'register'])->name('home.register');
Route::get('/email/validar', [HomeController::class, 'validarEmail'])->name('home.contrasena.validar_email');
Route::get('/contrasena/edit', [HomeController::class, 'editContrasena'])->name('home.contrasena.edit_contrasena');
Route::post('/contrasena/update/{user_id}', [HomeController::class, 'updateContrasena'])->name('home.contrasena.updateContrasena');

//user
Route::post('/usuario/login', [UsuariosController::class, 'login'])->name('user.login');
Route::get('/usuario/logout', [UsuariosController::class, 'logout'])->name('user.logout');
Route::put('/usuario/updateCredenciales', [UsuariosController::class, 'updateCredenciales'])->name('user.updateCredenciales');
Route::put('/usuario/updateFoto', [UsuariosController::class, 'updateFoto'])->name('user.updateFoto');
Route::delete('/usuario/{usuario}/destroy', [UsuariosController::class, 'destroy'])->name('user.destroy');
Route::put('/usuario/{usuario}/ban', [UsuariosController::class, 'ban'])->name('user.ban');
Route::put('/usuario/{usuario}/unban', [UsuariosController::class, 'unban'])->name('user.unban');
Route::post('/usuario/store', [UsuariosController::class, 'store'])->name('user.store');
Route::get('/usuario/contrasena/edit', [UsuariosController::class, 'editContrasena'])->name('user.contrasena.edit');
Route::put('/usuario/contrasena/update', [UsuariosController::class, 'updateContrasena'])->name('user.contrasena.update');

//comenzar
Route::get('/usuario/comenzar/filtrar', [ComenzarController::class, 'filtrarTematicas'])->name('user.comenzar.filtrar_tematicas');
Route::get('/usuario/comenzar/tematicas', [ComenzarController::class, 'listTematicas'])->name('user.comenzar.list_tematicas');
Route::get('/usuario/comenzar/tematicas/from_formulario/{tematica}', [ComenzarController::class, 'listTematicasFromFormulario'])->name('user.comenzar.list_tematicas.from_formulario');
Route::get('/usuario/comenzar/tematicas/{tematica}/preguntas', [ComenzarController::class, 'formulario'])->name('user.comenzar.formulario');
Route::put('/usuario/comenzar/tematicas/{tematica}/calcularResultado', [ComenzarController::class, 'calcularResultado'])->name('user.comenzar.calcularResultado');
Route::get('/usuario/comenzar/tematicas/{tematica}/resultado/show', [ComenzarController::class, 'showResultado'])->name('user.comenzar.show_resultado');

//admin
Route::get('/admin/idiomas', [AdminController::class, 'listIdiomas'])->name('admin.list_idiomas');
Route::get('/admin/usuarios', [AdminController::class, 'listUsuarios'])->name('admin.list_usuarios');
Route::get('/admin/idiomas/{idioma}/tematicas', [AdminController::class, 'listTematicas'])->name('admin.list_tematicas');
Route::get('/admin/tematicas/{tematica}/edit', [AdminController::class, 'editTematica'])->name('admin.edit_tematica');
Route::get('/admin/tematicas/{tematica}/{pregunta}/edit', [AdminController::class, 'editPregunta'])->name('admin.edit_pregunta');
Route::get('/admin/idiomas/{idioma}/edit', [AdminController::class, 'editIdioma'])->name('admin.edit_idioma');

//tematica
Route::post('/idiomas/{idioma}/tematica/store', [TematicasController::class, 'store'])->name('tematica.store');
Route::delete('/idiomas/tematicas/{tematica}/destroy', [TematicasController::class, 'destroy'])->name('tematica.destroy');
Route::put('/idiomas/tematicas/{tematica}/detalles/update', [TematicasController::class, 'updateDetalles'])->name('tematica.updateDetalles');
Route::put('/idiomas/tematicas/{tematica}/foto/update', [TematicasController::class, 'updateFoto'])->name('tematica.updateFoto');

//idioma
Route::post('/idiomas/store', [IdiomasController::class, 'store'])->name('idioma.store');
Route::put('/idiomas/{idioma}/updateNombre', [IdiomasController::class, 'updateNombre'])->name('idioma.updateNombre');
Route::put('/idiomas/{idioma}/updateFoto', [IdiomasController::class, 'updateFoto'])->name('idioma.updateFoto');
Route::delete('/idiomas/{idioma}/destroy', [IdiomasController::class, 'destroy'])->name('idioma.destroy');


//pregunta
Route::post('/idiomas/tematicas/{tematica}/pregunta/store', [PreguntasController::class, 'store'])->name('pregunta.store');
Route::delete('/idiomas/tematicas/preguntas/{pregunta}/delete', [PreguntasController::class, 'destroy'])->name('pregunta.destroy');
Route::put('/idiomas/tematicas/preguntas/{pregunta}/updateDetalles', [PreguntasController::class, 'updateDetalles'])->name('pregunta.updateDetalles');
Route::put('/idiomas/tematicas/preguntas/{pregunta}/updateAudio', [PreguntasController::class, 'updateAudio'])->name('pregunta.updateAudio');
Route::put('/idiomas/tematicas/preguntas/{pregunta}/deleteAudio', [PreguntasController::class, 'deleteAudio'])->name('pregunta.deleteAudio');

//enlace
Route::post('/idiomas/tematicas/{tematica}/enlaces/store',[EnlacesController::class, 'store'])->name('enlace.store');
Route::delete('/idiomas/tematicas/enlaces/{enlace}/delete', [EnlacesController::class, 'destroy'])->name('enlace.destroy');