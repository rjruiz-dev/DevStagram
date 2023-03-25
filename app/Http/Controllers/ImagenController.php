<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagenController extends Controller
{
    //
    public function store(Request $request) 
    {
        // Verificar que llega correctamente al endpoint
        // return "Desde Imagen Controller";
    
        // Identificar que archivo se esta subiendo
        // $input = $request->all();
        // return response()->json($input);
        
        // importante ('file') para reconocer el archivo
        $imagen = $request->file('file');

        return response()->json(['imagen' => $imagen->extension() ]);
    }
}
