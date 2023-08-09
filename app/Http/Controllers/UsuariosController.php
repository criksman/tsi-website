<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UsuarioEditarCredencialesRequest;
use Illuminate\Support\Facades\Storage;

class UsuariosController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['userLogin', 'userLogout']);
    }
    
    public function userLogin(LoginRequest $request){
        $usuario_id = $request->usuario_id;
        $password = $request->password;
    
        if(Auth::attempt(['usuario_id' => $usuario_id, 'password' => $password, 'estado' => true])){
            return redirect()->route('home.index');
        }
    
        return back()->withErrors([
            'usuario_id' => 'Nombre de usuario y/o Contraseña incorrectos.',
        ])->onlyInput('usuario_id');
    }

    public function userLogout(){
        Auth::logout();
        return redirect()->route('home.login');
    }

    public function userUpdateCredenciales(UsuarioEditarCredencialesRequest $request){
        
        $usuario_id = $request->usuario_id;
        $email = $request->email;

        $user = Auth::user();

        if ($usuario_id != null){
            $user->usuario_id = $usuario_id;
        }

        if ($email != null){
            $user->email = $email;
        }

        $user->save();

        return redirect()->route('home.index');
    }

    public function userUpdateFoto(Request $request){
        $user = Auth::user();

        $archivo = $request->file('foto');
        $nombre = $archivo->getClientOriginalName();
        $dir = 'public/documentos/img/users/' . $user->usuario_id;

        $path = $archivo->storeAs($dir, $nombre);

        $user->foto = $nombre;
        $user->save();

        return redirect()->route('home.index');
    }
}
