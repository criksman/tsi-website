<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Idioma;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['login']);
    }

    public function login(){
        return view("home.login");
    }

    public function index(){
        $idiomas = Idioma::all();
        
        return view("home.index", compact('idiomas'));
    }
}
