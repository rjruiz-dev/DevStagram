<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

        // Str::uuid(): genera un id unico para cada img
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // Usa InterventionImage pasamos la imagen que estaba en memoria a intervention para procesarla
        $imagenServidor = Image::make($imagen);
        
        // Cortar la imagen a 1000x1000 px
        $imagenServidor->fit(1000,1000);

        // Mover la imagen en el sevidor 
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;

        // La imagen en memoria la guardamos en uploads
        $imagenServidor->save($imagenPath);



        return response()->json(['imagen' => $nombreImagen ]);
    }
}
