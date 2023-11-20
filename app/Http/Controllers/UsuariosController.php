<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Idioma;
use App\Models\Dificultad;
use App\Models\Tematica;
use App\Models\Seccion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UsuarioEditarCredencialesRequest;
use App\Http\Requests\FiltrarTematicasRequest;
use App\Http\Requests\EditarUsuarioFotoRequest;
use App\Http\Requests\EditarContrasenaRequest;
use App\Http\Requests\RegistrarUsuarioRequest;
use Illuminate\Support\Facades\Storage;

class UsuariosController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['login', 'logout', 'store']);
    }
    
    public function login(LoginRequest $request){
        $username = $request->username;
        $password = $request->password;
    
        if(Auth::attempt(['username' => $username, 'password' => $password, 'estado' => true])){
            return redirect()->route('home.index');
        }
    
        return back()->withErrors([
            'usuario_id' => 'Nombre de usuario y/o Contraseña incorrectos.',
        ])->onlyInput('usuario_id');
    }

    public function logout(){
        Auth::logout();
        return redirect()->back();
    }

    public function store(RegistrarUsuarioRequest $request){
        $usuario = new Usuario();

        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);

        $usuario->save();

        $request->session()->flash('successRegistro', 'Usuario Registrado correctamente');
        
        return redirect()->back();
    }

    public function updateCredenciales(UsuarioEditarCredencialesRequest $request){
        
        $username = $request->username;
        $email = $request->email;

        $user = Auth::user();

        if ($username != null){
            $user->username = $username;
        }

        if ($email != null){
            $user->email = $email;
        }

        $user->save();

        return redirect()->back();
    }

    public function updateFoto(EditarUsuarioFotoRequest $request){
        $user = Auth::user();

        $archivo = $request->file('foto');
        $nombre = $archivo->getClientOriginalName();
        $dir = 'public/documentos/img/users/' . $user->user_id;

        $path = $archivo->storeAs($dir, $nombre);

        $user->foto = $nombre;
        $user->save();

        return redirect()->back();
    }

    public function editContrasena(){
        return view('user.contrasena.edit');
    }

    public function updateContrasena(EditarContrasenaRequest $request){
        $user = Auth::user();
        
        $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect()->back();
    }

    public function destroy(Usuario $usuario){
        $usuario->delete();

        Storage::deleteDirectory('public/documentos/img/users/' . $usuario->user_id);

        return redirect()->back();
    }

    public function ban(Usuario $usuario){
        $usuario->estado = 0;

        $usuario->save();
        
        return redirect()->back();
    }

    public function unban(Usuario $usuario){
        $usuario->estado = 1;

        $usuario->save();

        return redirect()->back();
    }
}
