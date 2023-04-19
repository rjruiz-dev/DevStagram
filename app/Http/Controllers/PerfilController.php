<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    // la ruta no esta protegida por lo tanto el usuario que no esta autenticado puede verlo
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() 
    {
        dd('aqui se muestra el formulario');
    }
}
