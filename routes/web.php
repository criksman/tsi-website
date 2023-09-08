<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IdiomasController;
use App\Http\Controllers\TematicasController;
use App\Http\Controllers\PreguntasController;
use App\Http\Controllers\EnlacesController;

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

//user
Route::post('/usuario/login', [UsuariosController::class, 'login'])->name('user.login');
Route::get('/usuario/logout', [UsuariosController::class, 'logout'])->name('user.logout');
Route::put('/usuario/updateCredenciales', [UsuariosController::class, 'updateCredenciales'])->name('user.updateCredenciales');
Route::put('/usuario/updateFoto', [UsuariosController::class, 'updateFoto'])->name('user.updateFoto');
Route::get('/usuario/filtrar', [UsuariosController::class, 'filtrarTematicas'])->name('user.filtrar_tematicas');
Route::get('/usuario/tematicas', [UsuariosController::class, 'showTematicas'])->name('user.show_tematicas');
Route::get('/usuario/tematicas/{tematica}/preguntas', [UsuariosController::class, 'showPreguntas'])->name('user.show_preguntas');
Route::put('/usuario/tematicas/{tematica}/calcularResultado', [UsuariosController::class, 'calcularResultado'])->name('user.calcularResultado');
Route::get('/usuario/tematicas/{tematica}/resultado', [UsuariosController::class, 'showResultado'])->name('user.show_resultado');
Route::delete('/usuario/{usuario}/destroy', [UsuariosController::class, 'destroy'])->name('user.destroy');
Route::put('/usuario/{usuario}/ban', [UsuariosController::class, 'ban'])->name('user.ban');
Route::put('/usuario/{usuario}/unban', [UsuariosController::class, 'unban'])->name('user.unban');


//admin
Route::get('/admin/idiomas', [AdminController::class, 'showIdiomas'])->name('admin.show_idiomas');
Route::get('/admin/idiomas/{idioma}/tematicas', [AdminController::class, 'showTematicas'])->name('admin.show_tematicas');
Route::get('/admin/tematicas/{tematica}/edit', [AdminController::class, 'editTematica'])->name('admin.edit_tematica');
Route::get('/admin/tematicas/{tematica}/{pregunta}/edit', [AdminController::class, 'editPregunta'])->name('admin.edit_pregunta');
Route::get('/admin/idiomas/{idioma}/edit', [AdminController::class, 'editIdioma'])->name('admin.edit_idioma');
Route::get('/admin/usuarios', [AdminController::class, 'showUsuarios'])->name('admin.show_usuarios');

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