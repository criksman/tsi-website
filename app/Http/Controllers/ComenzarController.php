<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Idioma;
use App\Models\Tematica;
use App\Models\Dificultad;
use App\Http\Requests\FiltrarTematicasRequest;
use App\Models\Seccion;
use Illuminate\Support\Facades\DB;

class ComenzarController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function filtrarTematicas(){
        $idiomas = Idioma::all();
        $dificultades = Dificultad::all();

        return view('user.comenzar.filtrar_tematicas', compact('idiomas', 'dificultades'));
    }

    public function listTematicas(FiltrarTematicasRequest $request){
        $idioma_id = $request->idioma_id;
        $dificultad_id = $request->dificultad_id;

        $tematicas = Tematica::where('idioma_id', $idioma_id)->where('dificultad_id', $dificultad_id)->get();
        $secciones = Seccion::all();

        return view('user.comenzar.list_tematicas', compact('tematicas', 'secciones'));
    }

    public function formulario(Tematica $tematica){
        $preguntas = $tematica->preguntas;

        return view('user.comenzar.formulario', compact('tematica', 'preguntas'));
    }

    public function calcularResultado(Request $request, Tematica $tematica){
        //LAS VARIABLES ACÁ TIENE QUE SER RENOMBRADAS, SON MUY REDUNDANTES Y CONFUNDEN :/
        
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

        $usuario = Auth::user();
        
        $progresoExistente = $usuario->tematicasConPivot()->where('tematica_user.tematica_id', $tematica->tematica_id)->first();
        
        if($progresoExistente){
            $usuario->tematicasConPivot()->updateExistingPivot($tematica->tematica_id,['progreso'=>$porcentaje]);
        }else{
            $usuario->tematicas()->attach($tematica->tematica_id, ['progreso'=>$porcentaje]);
        }

        $idioma = Idioma::find($tematica->idioma_id);

        $totalTematicas = $idioma->tematicas()->where('dificultad_id', $tematica->dificultad_id)->where('idioma_id', $tematica->idioma_id)->count();

        $tematicasAprobadas = $usuario->tematicasConPivot()->where('tematicas.dificultad_id', $tematica->dificultad_id)->where('tematicas.idioma_id', $tematica->idioma_id)->wherePivot('progreso', '>=', 55)->count();
        
        $promedioProgreso = ($tematicasAprobadas / $totalTematicas) * 100;

        //ocupo denuevo la misma variable y se la asigno a esta otra tabla... la verdad no se como poder hacer dos distintas con nombres apropiados
        //otro consejo es considerar que valor voy a guardar en el progreso... el porcentaje de tematicas aprobadas o el porcentaje promedio de todo.
        $progresoExistente = DB::table('dificultad_idioma_user')
            ->where('dificultad_id', $tematica->dificultad_id)
            ->where('idioma_id', $idioma->idioma_id)
            ->where('user_id', $usuario->user_id)
            ->first();
        
        if ($progresoExistente){
            DB::table('dificultad_idioma_user')
            ->where('dificultad_id', $tematica->dificultad_id)
            ->where('idioma_id', $idioma->idioma_id)
            ->where('user_id', $usuario->user_id)
            ->update(['progreso' => $promedioProgreso]);
        }else{
            $usuario->progresoDificultadIdioma()->attach($tematica->dificultad_id ,['progreso' => $promedioProgreso, 'idioma_id' => $idioma->idioma_id, 'user_id' => $usuario->user_id]);
        }

        return redirect()->route('user.comenzar.show_resultado', compact('tematica'))->with('porcentaje', $porcentaje);
    }

    public function showResultado(Request $request, Tematica $tematica){
        $porcentaje = $request->session()->get('porcentaje');
        return view('user.comenzar.show_resultado', compact('tematica', 'porcentaje'));
    }
}
