<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // dd('Dando Like');
        // dd($post->id);
        // dd($request->user()->id);

        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();

    }

    public function destroy(Request $request, Post $post)
    {
        // dd('Eliminando Like');
       
        // en el request viene el usuario
        // y el usuario ya tiene la relacion like asociado al modelo
        // filtramos el post acutal y eliminamos
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();

    }
}
