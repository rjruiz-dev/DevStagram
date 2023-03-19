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

        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);




    }
}
