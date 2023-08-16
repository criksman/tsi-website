<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idioma;
use App\Models\Tematica;
use App\Models\Dificultad;
use App\Http\Requests\CrearTematicaRequest;
use App\Http\Requests\EditarTematicaDetallesRequest;
use App\Http\Requests\EditarTematicaFotoRequest;

class TematicasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function store(CrearTematicaRequest $request, Idioma $idioma){
        $tematica = new Tematica();

        $tematica->idioma_id = $idioma->idioma_id;
        $tematica->nombre = $request->nombre;
        $tematica->seccion_id = $request->seccion_id;
        $tematica->dificultad_id = $request->dificultad_id;
        $tematica->descripcion = $request->descripcion;
        
        $archivo = $request->file('foto');
        $nombre = $archivo->getClientOriginalName();
        
        $tematica->foto = $nombre;

        $tematica->save();
        
        $dir = 'public/documentos/img/tematicas/' . $tematica->tematica_id;

        $path = $archivo->storeAs($dir, $nombre);

        $tematicas = $idioma->tematicas;
        $dificultades = Dificultad::orderBy('dificultad_id')->get();

        return redirect()->back();
    }

    public function destroy(Idioma $idioma, Tematica $tematica){
        $tematica->delete();

        $tematicas = $idioma->tematicas;
        $dificultades = Dificultad::orderBy('dificultad_id')->get();
    
        return redirect()->back();
    }

    public function updateDetalles(EditarTematicaDetallesRequest $request, Idioma $idioma, Tematica $tematica){
        $nombre = $request->nombre;
        $descripcion = $request->descripcion;
        $seccion_id = $request->seccion_id;

        if ($nombre != null){
            $tematica->nombre = $nombre;
        }

        if ($descripcion != null){
            $tematica->descripcion = $descripcion;
        }

        $tematica->seccion_id = $seccion_id;

        $tematica->save();

        $preguntas = $tematica->preguntas;

        return redirect()->back();
    }

    public function updateFoto(EditarTematicaFotoRequest $request, Idioma $idioma, Tematica $tematica){
        $archivo = $request->file('foto');
        $nombre = $archivo->getClientOriginalName();
        
        $tematica->foto = $nombre;
        
        $dir = 'public/documentos/img/tematicas/' . $tematica->tematica_id;

        $path = $archivo->storeAs($dir, $nombre);

        $tematica->save();

        $preguntas = $tematica->preguntas;

        return redirect()->back();
    }
}
