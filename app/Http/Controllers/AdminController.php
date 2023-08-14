<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Idioma;
use App\Models\Tematica;

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
        $facilTematicas = $idioma->tematicas()->dificultad()->where('nombre', 'facil')->get();
        $medioTematicas = $idioma->tematicas()->dificultad()->where('nombre', 'medio')->get();
        $dificilTematicas = $idioma->tematicas()->dificultad()->where('nombre', 'dificil')->get();

        return view('admin.show_tematicas', compact('tematicas'));
    }

}
