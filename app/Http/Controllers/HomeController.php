<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Usuario;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['login']);
    }

    public function login(){
        return view("home.login");
    }

    public function index(){
        return view("home.index");
    }
}
