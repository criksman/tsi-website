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
        $tematicas = $idioma->tematicas();

        return view('admin.show_tematicas', compact('tematicas'));
    }

}
