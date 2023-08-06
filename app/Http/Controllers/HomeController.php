<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Usuario;

class HomeController extends Controller
{
    public function login(){
        return view("home.login");
    }

    public function userLogin(Request $request){
        $usuario_id = $request->usuario_id;
        $password = $request->password;

        if(Auth::attempt(['usuario_id'=>$usuario_id,'password'=>$password, 'estado'=>true])){
            return redirect()->route('home.index');
        }

        return back()->withErrors([
            'usuario_id' => 'Credenciales Incorrectas',
        ])->onlyInput('usuario_id');
    }

    public function index(){
        return view("home.index");
    }
}
