<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Idioma;
use App\Models\Dificultad;
use App\Models\Tematica;
use App\Models\Seccion;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UsuarioEditarCredencialesRequest;
use App\Http\Requests\FiltrarTematicasRequest;
use Illuminate\Support\Facades\Storage;

class UsuariosController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['login', 'logout']);
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

    public function updateFoto(Request $request){
        $user = Auth::user();

        $archivo = $request->file('foto');
        $nombre = $archivo->getClientOriginalName();
        $dir = 'public/documentos/img/users/' . $user->user_id;

        $path = $archivo->storeAs($dir, $nombre);

        $user->foto = $nombre;
        $user->save();

        return redirect()->back();
    }

    public function filtrarTematicas(){
        $idiomas = Idioma::all();
        $dificultades = Dificultad::all();

        return view('user.filtrar_tematicas', compact('idiomas', 'dificultades'));
    }

    public function showTematicas(FiltrarTematicasRequest $request){
        $idioma_id = $request->idioma_id;
        $dificultad_id = $request->dificultad_id;

        $tematicas = Tematica::where('idioma_id', $idioma_id)->where('dificultad_id', $dificultad_id)->get();
        $secciones = Seccion::all();

        return view('user.show_tematicas', compact('tematicas', 'secciones'));
    }


    // de aqui en adelante yo creo que pertenecen a un controller para la prueba en si
    public function showPreguntas(Tematica $tematica){
        $preguntas = $tematica->preguntas;

        return view('user.show_preguntas', compact('tematica', 'preguntas'));
    }

    public function calcularResultado(Request $request, Tematica $tematica){
        $totalPreguntas = count($tematica->preguntas);

        $preguntasCorrectas = 0;

        foreach ($tematica->preguntas as $pregunta) {
            $pregunta_id = $pregunta->pregunta_id;
            $inputId = "pregunta_{$pregunta_id}";
    
            if ($request->has($inputId)) {
                $preguntaSeleccionada = $request->input($inputId);
    
                if ($preguntaSeleccionada === $pregunta->respuesta_corr) {
                    $preguntasCorrectas++;
                }
            }
        }

        $porcentaje = ($preguntasCorrectas / $totalPreguntas) * 100;

        return redirect()->route('user.show_resultado', compact('tematica'))->with('porcentaje', $porcentaje);;
    }

    public function showResultado(Request $request, Tematica $tematica){
        $porcentaje = $request->session()->get('porcentaje');
        return view('user.show_resultado', compact('tematica', 'porcentaje'));
    }

    public function destroy(Usuario $usuario){
        $usuario->delete();

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
