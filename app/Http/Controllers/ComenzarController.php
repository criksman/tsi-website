<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Idioma;
use App\Models\Tematica;
use App\Models\Dificultad;
use App\Http\Requests\FiltrarTematicasRequest;
use App\Models\Seccion;

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

        //Guardar valor
        $usuario = Auth::user();

        //esta variable hay que renombrarla para que se entienda mejor
        $pivot = $usuario->tematicasConPivot()->where('tematica_usuario.tematica_id', $tematica->tematica_id)->first();
        
        if($pivot){
            $usuario->tematicasConPivot()->updateExistingPivot($tematica->tematica_id,['progreso'=>$porcentaje]);
        }else{
            $usuario->tematicas()->attach($tematica->tematica_id, ['progreso'=>$porcentaje]);
        }
        
        return redirect()->route('user.comenzar.show_resultado', compact('tematica'))->with('porcentaje', $porcentaje);
    }

    public function showResultado(Request $request, Tematica $tematica){
        $porcentaje = $request->session()->get('porcentaje');
        return view('user.comenzar.show_resultado', compact('tematica', 'porcentaje'));
    }
}