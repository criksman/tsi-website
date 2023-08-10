<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AdminController;

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

//user
Route::get('/', [HomeController::class, 'login'])->name('home.login');
Route::get('/index', [HomeController::class, 'index'])->name('home.index');
Route::post('/userLogin', [UsuariosController::class, 'userLogin'])->name('user.login');
Route::get('/userLogout', [UsuariosController::class, 'userLogout'])->name('user.logout');
Route::put('/userUpdateCredenciales', [UsuariosController::class, 'userUpdateCredenciales'])->name('user.updateCredenciales');
Route::put('/userUpdateFoto', [UsuariosController::class, 'userUpdateFoto'])->name('user.updateFoto');


//admin
Route::get('/admin/idiomas', [AdminController::class, 'idiomas'])->name('admin.idiomas');
