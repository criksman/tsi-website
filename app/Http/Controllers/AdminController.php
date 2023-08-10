<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Idioma;

class AdminController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
    }

    public function idiomas(){
        $idiomas = Idioma::all();

        return view('admin.idiomas', compact('idiomas'));
    }
}
