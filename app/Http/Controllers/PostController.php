<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index() 
    {
        // dd('Desde Muro');
        
        // Usuario autenticado actualmente
        dd(auth()->user());
    }
}
