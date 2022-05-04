<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactaController extends Controller
{

    public function index()
    {
        return view('contacta');
    }
}
