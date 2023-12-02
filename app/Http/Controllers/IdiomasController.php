<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idioma;
use App\Http\Requests\CrearIdiomaRequest;
use App\Http\Requests\EditarIdiomaRequest;
use App\Http\Requests\EditarIdiomaNombreRequest;
use App\Http\Requests\EditarIdiomaFotoRequest;

class IdiomasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(CrearIdiomaRequest $request){
        
        $idioma = new Idioma();

        $idioma->nombre = $request->nombre;

        $archivo = $request->file('foto');
        $nombre = $archivo->getClientOriginalName();

        $idioma->foto = $nombre;
        $idioma->save();

        $dir = 'public/documentos/img/idiomas/' . $idioma->idioma_id;

        $path = $archivo->storeAs($dir, $nombre);
        
        return redirect()->back();
    }

    public function updateNombre(EditarIdiomaNombreRequest $request, Idioma $idioma){
        $idioma->nombre = $request->nombre;
        $idioma->save();

        $request->session()->flash('success', 'Cambios aplicados correctamente');

        return redirect()->back();
    }

    public function updateFoto(EditarIdiomaFotoRequest $request, Idioma $idioma){
        $archivo = $request->file('foto');
        $nombre = $archivo->getClientOriginalName();

        $idioma->foto = $nombre;
        $idioma->save();

        $dir = 'public/documentos/img/idiomas/' . $idioma->idioma_id;

        $path = $archivo->storeAs($dir, $nombre);

        $request->session()->flash('successFoto', 'Cambios aplicados correctamente');
        
        return redirect()->back();
    }

    public function destroy(Idioma $idioma){
        $idioma->delete();

        return redirect()->route('admin.list_idiomas');
    }
    
}
