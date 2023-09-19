<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enlace;
use App\Models\Tematica;
use App\Http\Requests\CrearEnlacesRequest;

class EnlacesController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['login']);
    }

    public function store(CrearEnlacesRequest $request, Tematica $tematica){
        $enlace = new Enlace();

        $enlace->link = $request->link;
        $enlace->tematica_id = $tematica->tematica_id;
        $enlace->descripcion = $request->descripcion;

        $enlace->save();

        return redirect()->back();
    }

    public function destroy(Enlace $enlace){
        $enlace->delete();

        return redirect()->back();
    }
}
