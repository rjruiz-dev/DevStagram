<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // controlador con un solo metodo
    // es como un constructor, automaticamente se manda a llamar
    public function __invoke()
    {
       return view('home');       
    }
}
