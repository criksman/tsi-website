<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pregunta;
use App\Models\Tematica;
use App\Http\Requests\CrearPreguntaRequest;

class PreguntasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function store(CrearPreguntaRequest $request, Tematica $tematica){
        $pregunta = new Pregunta();

        $pregunta->tematica_id = $tematica->tematica_id;
        $pregunta->enunciado = $request->enunciado;
        $pregunta->respuesta_corr = $request->respuesta_corr;
        $pregunta->respuesta_inc1 = $request->respuesta_inc1;
        $pregunta->respuesta_inc2 = $request->respuesta_inc2;
        $pregunta->respuesta_inc3 = $request->respuesta_inc3;

        if ($request->audio != null){
            $archivo = $request->file('audio');
            $nombre = $archivo->getClientOriginalName();

            $pregunta->audio = $nombre;
            $pregunta->save();

            $dir = 'public/documentos/audio/preguntas/' . $pregunta->pregunta_id;

            $path = $archivo->storeAs($dir, $nombre);
        
        }else{
            $pregunta->save();
        }

        return redirect()->back();
    }

    public function destroy(Pregunta $pregunta){
        $pregunta->delete();

        return redirect()->back();
    }
}
