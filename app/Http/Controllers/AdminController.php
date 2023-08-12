<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Idioma;
use App\Http\Requests\CrearIdiomaRequest;
use App\Http\Requests\EditarIdiomaRequest;
use App\Http\Requests\EditarIdiomaImagenRequest;

class AdminController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
    }

    public function idiomas(){
        $idiomas = Idioma::all();

        return view('admin.idiomas', compact('idiomas'));
    }

    public function storeIdioma(CrearIdiomaRequest $request){
        
        $idioma = new Idioma();

        $idioma->nombre = $request->nombre;
        
        $archivo = $request->file('foto');
        $nombre = $archivo->getClientOriginalName();

        $idioma->foto = $nombre;
        $idioma->save();

        $dir = 'public/documentos/img/idiomas/' . $idioma->id;

        $path = $archivo->storeAs($dir, $nombre);
        
        return redirect()->route('admin.idiomas');
    }

    public function destroyIdioma(Idioma $idioma){
        $idioma->delete();

        return redirect()->route('admin.idiomas');
    }
}
