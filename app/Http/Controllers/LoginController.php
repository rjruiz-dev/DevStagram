<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index() 
    {
        return view('auth.login');
    }

    public function store(Request $request) 
    {
        // dd('Autenticando...');
        
        // dd($request->remember);

        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);        

        // En caso de que el usario no se pueda auenticar, crear msj para informar al usuario
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            // back: vuelve a donde enviaste esta info, pero va con msj de error
            return back()->with('mensaje', 'Credenciales Incorrectas'); // coloca el msj en una sesion
        }

        // si retorna true
        return redirect()->route('posts.index');
    }
}
