<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    // $user: la persona que estamos siguiendo 
    // $request: lo que estamos enviando, tiene la persona que esta siguiendo ese usuario
    public function store(User $user, Request $request)
    {
        // dd($user->username);

        // followers(): para crear ese seguidor
        // attach(): util para relacion de muchos a muchos tabla pivote, relacion con la misma tabla
        // $user: lee el usuario que estamos visitando su muro
        // followers()->attach: agrega la persona que esta siguiendo
        // auth()->user()->id: va a ser la persona que esta autenticada
        $user->followers()->attach( auth()->user()->id );
        
        return back();
    }
}
