<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // Para que puedan ver la pag principal tiene que estar autenticados
        $this->middleware('auth');
    }

    // controlador con un solo metodo
    // __invoke: es como un constructor, automaticamente se manda a llamar
    public function __invoke()
    {
        // Obtener a quienes seguimos
        // auth(): la paersona que esta autenticada
        // user()->followings: user metdodo del modelo user
        // pluck('id'): obtiene el campo que le especificamos 
        // toArray(): arreglo con la info de la persona que estoy siguiendo
        // dd( auth()->user()->followings->pluck('id')->toArray() );
        $ids = ( auth()->user()->followings->pluck('id')->toArray() );

        // whereIn: filtrar un arreglo por user_id
        // latest(): las ultimas publicaciones se muestran primero
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        // dd($posts);

        return view('home', [
            'posts' => $posts 
        ]);       
    }
}
