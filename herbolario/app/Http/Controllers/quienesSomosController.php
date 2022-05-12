<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class quienesSomosController extends Controller
{
    public function index(){
        return view('home.quienes_somos');
    }
}
