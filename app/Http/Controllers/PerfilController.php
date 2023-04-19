<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class PerfilController extends Controller
{
    // la ruta no esta protegida por lo tanto el usuario que no esta autenticado puede verlo
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() 
    {
        // dd('aqui se muestra el formulario');
        return view('perfil.index');
    }
}
