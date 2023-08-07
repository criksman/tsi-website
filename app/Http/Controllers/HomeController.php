<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function login(){
        return view("home.login");
    }

    public function index(){
        return view("home.index");
    }
}
