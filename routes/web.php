<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IdiomasController;
use App\Http\Controllers\TematicasController;

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

//admin
Route::get('/admin/idiomas', [AdminController::class, 'showIdiomas'])->name('admin.show_idiomas');
Route::get('/admin/{idioma}/tematicas', [AdminController::class, 'showTematicas'])->name('admin.show_tematicas');

//tematica
Route::post('{idioma}/tematica/store', [TematicasController::class, 'store'])->name('tematica.store');

//idioma
Route::post('/idiomas/store', [IdiomasController::class, 'store'])->name('idioma.store');
Route::delete('/idiomas/destroy/{idioma}', [IdiomasController::class, 'destroy'])->name('idioma.destroy');