<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
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

    public function store(Request $request)
    {
        // dd('Guardando cambios');

        // Modificar el Request reescribir username
        $request->request->add(['username' => Str::slug($request->username)]);
        
        // la validacion pasa aunque no edite el username: 'unique:users,username,'.auth()->user()->id
        // podemos crear validacion de lista negra de palabras: palabras que no deben incluirse
        $this->validate($request,[
            'username'  => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20',
            'not_in:twitter,editar-perfil'],
        ]);

    }
}
