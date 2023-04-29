<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // controlador con un solo metodo
    // es como un constructor, automaticamente se manda a llamar
    public function __invoke()
    {
        // Obtener a quienes seguimos
        // auth(): la paersona que esta autenticada
        // user()->followings: user metdodo del modelo user
        // pluck('id'): obtiene el campo que le especificamos 
        // toArray(): arreglo con la info de la persona que estoy siguiendo
        dd( auth()->user()->followings->pluck('id')->toArray() );
        return view('home');       
    }
}
