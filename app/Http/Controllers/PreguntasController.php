<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Models\Pregunta;
use App\Models\Tematica;
use App\Models\Dificultad;
//use App\Models\Usuario;
use App\Models\Idioma;

use App\Http\Requests\CrearPreguntaRequest;
use App\Http\Requests\EditarPreguntaRequest;
use App\Http\Requests\EditarPreguntaAudioRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Auth;

use App\Traits\ActualizarProgresoUsuariosTrait;

class PreguntasController extends Controller
{
    use ActualizarProgresoUsuariosTrait;
    
    public function __construct(){
        $this->middleware('auth');
    }

    private function eliminarProgreso(Tematica $tematica){
        DB::table('tematica_user')
            ->where('tematica_id', $tematica->tematica_id)
            ->delete();
    }

    private function actualizarProgresoUsuariosOperation(Pregunta $pregunta) {
        $tematica = Tematica::find($pregunta->tematica_id);
        $this->eliminarProgreso($tematica);
    
        $dificultad = Dificultad::find($pregunta->tematica->dificultad_id);
        $idioma = Idioma::find($pregunta->tematica->idioma_id);
    
        $this->actualizarProgresoUsuarios($idioma, $dificultad);
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

        $this->actualizarProgresoUsuariosOperation($pregunta);

        return redirect()->back();
    }

    public function destroy(Pregunta $pregunta){   
        $this->actualizarProgresoUsuariosOperation($pregunta);
        
        $pregunta->delete();

        if ($pregunta->tematica->seccion_id == 2){
            Storage::deleteDirectory('public/documentos/audio/preguntas/' . $pregunta->pregunta_id);
        }

        return redirect()->back();
    }

    public function updateDetalles(EditarPreguntaRequest $request, Pregunta $pregunta){
        $enunciado = $request->enunciado;
        $respuesta_corr = $request->respuesta_corr;
        $respuesta_inc1 = $request->respuesta_inc1;
        $respuesta_inc2 = $request->respuesta_inc2;
        $respuesta_inc3 = $request->respuesta_inc3;

        if ($enunciado === null && $respuesta_corr === null && $respuesta_inc1 === null && $respuesta_inc2 === null && $respuesta_inc3 === null) {
            $request->session()->flash('errorEnunciadoResp', 'No se ingresó ningún dato.');
        } else {
            if ($enunciado != null){
                $pregunta->enunciado = $enunciado;
            }
    
            if ($respuesta_corr != null){
                $pregunta->respuesta_corr = $respuesta_corr;
            }
    
            if ($respuesta_inc1 != null){
                $pregunta->respuesta_inc1 = $respuesta_inc1;
            }
    
            if ($respuesta_inc2 != null){
                $pregunta->respuesta_inc2 = $respuesta_inc2;
            }
    
            if ($respuesta_inc3 != null){
                $pregunta->respuesta_inc3 = $respuesta_inc3;
            }

            $pregunta->save();

            $this->actualizarProgresoUsuariosOperation($pregunta);

            $request->session()->flash('successEnunciadoResp', 'Cambios aplicados correctamente');
        }

        return redirect()->back();
    }

    public function updateAudio(EditarPreguntaAudioRequest $request, Pregunta $pregunta){
        $archivo = $request->file('audio');
        $nombre = $archivo->getClientOriginalName();
    
        $pregunta->audio = $nombre;
    
        $dir = 'public/documentos/audio/preguntas/' . $pregunta->pregunta_id;
    
        $path = $archivo->storeAs($dir, $nombre);

        $pregunta->save();

        $this->actualizarProgresoUsuariosOperation($pregunta);

        $request->session()->flash('successFoto', 'Cambios aplicados correctamente');
        
        return redirect()->back();
    }

    public function deleteAudio(Pregunta $pregunta){
        $pregunta->audio = null;

        $pregunta->save();
        
        $this->actualizarProgresoUsuariosOperation($pregunta);

        Storage::deleteDirectory('public/documentos/audio/preguntas/' . $pregunta->pregunta_id);
        
        return redirect()->back();
    }
}
