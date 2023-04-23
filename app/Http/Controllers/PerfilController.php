<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    // la ruta no esta protegida por lo tanto el usuario que no esta autenticado puede verlo
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() 
    {
        // dd('aqui se muestra el formulario');
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // dd('Guardando cambios');

        // Modificar el Request reescribir username
        $request->request->add(['username' => Str::slug($request->username)]);
        
        // la validacion pasa aunque no edite el username: 'unique:users,username,'.auth()->user()->id
        // podemos crear validacion de lista negra de palabras: palabras que no deben incluirse
        $this->validate($request,[
            'username'  => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20',
            'not_in:twitter,editar-perfil'],
        ]);

        if ($request->imagen) {
            // dd('Si hay imagen'); 
            
            // importante ('file') para reconocer el archivo
            $imagen = $request->file('imagen');

            // Str::uuid(): genera un id unico para cada img
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            // Usa InterventionImage pasamos la imagen que estaba en memoria a intervention para procesarla
            $imagenServidor = Image::make($imagen);
            
            // Cortar la imagen a 1000x1000 px
            $imagenServidor->fit(1000,1000);

            // Mover la imagen en el sevidor 
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            // La imagen en memoria la guardamos en perfiles
            $imagenServidor->save($imagenPath);
        }

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        // Si no hay imagen en el formulario pero si tiene imagen en la base de datos, evitamos reemplazo de imagen
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null; // existe el nombre del imagen o lo deja null
        $usuario->save();

        // Redireccionar 
        return redirect()->route('posts.index', $usuario->username); // al redireccionar lee el usario modificado

    }
}
