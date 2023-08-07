<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
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
}
