<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // __construct() se ejecuta cuando es instanciada esta clase controlador
    public function __construct()
    {
        // protegemos con middleware, antes de mostrar el index revisa que el usuario este autentiacado
        $this->middleware('auth');
    }

    public function index(User $user) 
    {
        // dd('Desde Muro');
        
        // Usuario autenticado actualmente
        // dd(auth()->user());

        // dd($user->username);

        return view('dashboard');
    }
}
