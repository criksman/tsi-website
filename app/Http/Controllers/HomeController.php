<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Idioma;
use App\Http\Requests\ValidarEmailRequest;
use App\Http\Requests\RestablecerContrasenaRequest;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['login', 'register', 'validarEmail', 'editContrasena', 'updateContrasena']);
    }

    public function login(){
        return view("home.login");
    }

    public function index(){
        $idiomas = Idioma::all();
        
        return view("home.index", compact('idiomas'));
    }

    public function register(){ 
        return view("home.register");
    }

    public function validarEmail(){
        return view("home.contrasena.validar_email");
    }

    public function editContrasena(ValidarEmailRequest $request){
        $email = $request->email;
        $usuario = Usuario::where('email', $email)->first();
        
        return view("home.contrasena.edit_contrasena", compact('usuario'));
    }

    public function updateContrasena(RestablecerContrasenaRequest $request, $user_id){
        $requestUsername = $request->username;
        $usuario = Usuario::find($user_id);
        
        if($requestUsername != $usuario->username){
            return redirect()->back()->withErrors(['username' => 'El nombre de usuario no esta asociado a su email'])->withInput();
        }

        $usuario->password = Hash::make($request->password);;

        $usuario->save();
        
        return redirect()->back();
    }
}
