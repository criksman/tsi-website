<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pregunta;
use App\Models\Tematica;
use App\Http\Requests\CrearPreguntaRequest;
use App\Http\Requests\EditarPreguntaRequest;
use App\Http\Requests\EditarPreguntaAudioRequest;

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

    public function updateDetalles(EditarPreguntaRequest $request, Pregunta $pregunta){
        if ($request->enunciado != null){
            $pregunta->enunciado = $request->enunciado;
        }

        if ($request->respuesta_corr != null){
            $pregunta->respuesta_corr = $request->respuesta_corr;
        }

        if ($request->respuesta_inc1 != null){
            $pregunta->respuesta_inc1 = $request->respuesta_inc1;
        }

        if ($request->respuesta_inc2 != null){
            $pregunta->respuesta_inc2 = $request->respuesta_inc2;
        }

        if ($request->respuesta_inc3 != null){
            $pregunta->respuesta_inc3 = $request->respuesta_inc3;
        }

        $pregunta->save();

        $request->session()->flash('success', 'Cambios aplicados correctamente');

        return redirect()->back();
    }

    public function updateAudio(EditarPreguntaAudioRequest $request, Pregunta $pregunta){
        $archivo = $request->file('audio');
        $nombre = $archivo->getClientOriginalName();
    
        $pregunta->audio = $nombre;
    
        $dir = 'public/documentos/audio/preguntas/' . $pregunta->pregunta_id;
    
        $path = $archivo->storeAs($dir, $nombre);

        $pregunta->save();

        $request->session()->flash('successFoto', 'Cambios aplicados correctamente');
        
        return redirect()->back();
    }

    public function deleteAudio(Pregunta $pregunta){
        $pregunta->audio = null;

        $pregunta->save();
        
        return redirect()->back();
    }
}
