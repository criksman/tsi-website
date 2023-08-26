<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IdiomasController;
use App\Http\Controllers\TematicasController;
use App\Http\Controllers\PreguntasController;

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
Route::post('/login', [UsuariosController::class, 'login'])->name('user.login');
Route::get('/logout', [UsuariosController::class, 'logout'])->name('user.logout');
Route::put('/updateCredenciales', [UsuariosController::class, 'updateCredenciales'])->name('user.updateCredenciales');
Route::put('/updateFoto', [UsuariosController::class, 'updateFoto'])->name('user.updateFoto');
Route::get('/user/filtrar', [UsuariosController::class, 'filtrarTematicas'])->name('user.filtrar_tematicas');
Route::get('/user/tematicas', [UsuariosController::class, 'showTematicas'])->name('user.show_tematicas');
Route::get('/user/{tematica}/preguntas', [UsuariosController::class, 'showPreguntas'])->name('user.show_preguntas');
Route::put('/user/{tematica}/calcularResultado', [UsuariosController::class, 'calcularResultado'])->name('user.calcularResultado');
Route::get('/user/{tematica}/resultado', [UsuariosController::class, 'showResultado'])->name('user.show_resultado');

//admin
Route::get('/admin/idiomas', [AdminController::class, 'showIdiomas'])->name('admin.show_idiomas');
Route::get('/admin/{idioma}/tematicas', [AdminController::class, 'showTematicas'])->name('admin.show_tematicas');
Route::get('/admin/{tematica}/edit', [AdminController::class, 'editTematica'])->name('admin.edit_tematica');
Route::get('/admin/{tematica}/{pregunta}/edit', [AdminController::class, 'editPregunta'])->name('admin.edit_pregunta');

//tematica
Route::post('/{idioma}/tematica/store', [TematicasController::class, 'store'])->name('tematica.store');
Route::delete('/{tematica}/destroy', [TematicasController::class, 'destroy'])->name('tematica.destroy');
Route::put('/{tematica}/detalles/update', [TematicasController::class, 'updateDetalles'])->name('tematica.updateDetalles');
Route::put('/{tematica}/foto/update', [TematicasController::class, 'updateFoto'])->name('tematica.updateFoto');

//idioma
Route::post('/idioma/store', [IdiomasController::class, 'store'])->name('idioma.store');
Route::delete('/{idioma}/destroy', [IdiomasController::class, 'destroy'])->name('idioma.destroy');

//pregunta
Route::post('/{tematica}/pregunta/store', [PreguntasController::class, 'store'])->name('pregunta.store');
Route::delete('/{pregunta}/delete', [PreguntasController::class, 'destroy'])->name('pregunta.destroy');
Route::put('/{pregunta}/updateDetalles', [PreguntasController::class, 'updateDetalles'])->name('pregunta.updateDetalles');
Route::put('/{pregunta}/updateAudio', [PreguntasController::class, 'updateAudio'])->name('pregunta.updateAudio');
Route::put('/{pregunta}/deleteAudio', [PreguntasController::class, 'deleteAudio'])->name('pregunta.deleteAudio');