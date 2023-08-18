<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idioma;
use App\Http\Requests\CrearIdiomaRequest;
use App\Http\Requests\EditarIdiomaRequest;
use App\Http\Requests\EditarIdiomaImagenRequest;

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

    public function destroy(Idioma $idioma){
        $idioma->delete();

        return redirect()->back();
    }
}
