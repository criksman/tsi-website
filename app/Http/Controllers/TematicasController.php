<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idioma;
use App\Models\Tematica;
use App\Models\Dificultad;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CrearTematicaRequest;
use App\Http\Requests\EditarTematicaDetallesRequest;
use App\Http\Requests\EditarTematicaFotoRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\ActualizarProgresoTrait;
use Illuminate\Support\Facades\Storage;

class TematicasController extends Controller
{
    use ActualizarProgresoTrait;
    
    public function __construct(){
        $this->middleware('auth');
    }

    private function eliminarProgreso(Tematica $tematica){
        DB::table('tematica_user')
            ->where('tematica_id', $tematica->tematica_id)
            ->delete();
    }

    private function actualizarProgresoOperation(Tematica $tematica) {
        $this->eliminarProgreso($tematica);
    
        $dificultad = Dificultad::find($tematica->dificultad_id);
        $idioma = Idioma::find($tematica->idioma_id);
        $usuario = Usuario::find(Auth::user()->user_id);
    
        $this->actualizarProgreso($usuario, $idioma, $dificultad);
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
        
        //Actualizar progreso (cantidad total de tematicas ha aumentado)
        $usuario = Usuario::find(Auth::user()->user_id);
        $idioma = Idioma::find($idioma->idioma_id);
        $dificultad = Dificultad::find($tematica->dificultad_id);

        $this->actualizarProgreso($usuario, $idioma, $dificultad);

        return redirect()->back();
    }

    public function destroy(Tematica $tematica){
        Storage::deleteDirectory('public/documentos/img/tematicas/' . $tematica->tematica_id);

        $this->actualizarProgresoOperation($tematica);

        $tematica->delete();

        return redirect()->back();
    }

    public function updateDetalles(EditarTematicaDetallesRequest $request, Tematica $tematica){
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

        return redirect()->back();
    }

    public function updateFoto(EditarTematicaFotoRequest $request, Tematica $tematica){
        $archivo = $request->file('foto');
        $nombre = $archivo->getClientOriginalName();
        
        $tematica->foto = $nombre;
        
        $dir = 'public/documentos/img/tematicas/' . $tematica->tematica_id;

        $path = $archivo->storeAs($dir, $nombre);

        $tematica->save();

        return redirect()->back();
    }
}
