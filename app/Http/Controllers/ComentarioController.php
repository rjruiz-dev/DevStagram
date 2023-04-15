<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        // dd('Comentando...');
        
        // validar
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        // almacenar el resultado
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario,
        ]);

        // retornar a la pagina anterior e imprimir msj
        return back()->with('mensaje', 'Comentario realizado correctamente');

    }
}
