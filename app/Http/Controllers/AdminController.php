<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Idioma;
use App\Models\Tematica;
use App\Models\Pregunta;
use App\Models\Dificultad;

class AdminController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
    }

    public function showIdiomas(){
        $idiomas = Idioma::all();

        return view('admin.show_idiomas', compact('idiomas'));
    }

    public function showTematicas(Idioma $idioma){
        $tematicas = $idioma->tematicas;
        $dificultades = Dificultad::orderBy('dificultad_id')->get();

        return view('admin.show_tematicas', compact('idioma','tematicas', 'dificultades'));
    }

    public function editTematica(Tematica $tematica){
        $idioma = $tematica->idioma;
        
        if (!$tematica->preguntas->isEmpty()){
            $escrito = ($tematica->seccion->seccion_id == 1);
            $tematica->estado = true;
            foreach ($tematica->preguntas as $pregunta) {
                if ($escrito && $pregunta->audio != null) {
                    $tematica->estado = false;
                    break;
                } elseif (!$escrito && $pregunta->audio == null) {
                    $tematica->estado = false;
                    break;
                }
            }
            $tematica->save();
        }else{
            $tematica->estado = false;
            $tematica->save();
        }
        

        return view('admin.edit_tematica', compact('idioma', 'tematica'));
    }

}
