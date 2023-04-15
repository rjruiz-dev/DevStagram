<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // __construct() se ejecuta cuando es instanciada esta clase controlador
    public function __construct()
    {
        // protegemos con middleware, antes de mostrar el index revisa que el usuario este autentiacado
        // con except "este controlador va a estar protegido excepto los sig metodos"
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user) 
    {
        // dd('Desde Muro');
        
        // Usuario autenticado actualmente
        // dd(auth()->user());

        // dd($user->username);

        // consultar la tabla posts y filtrar por el id de la url
        $posts = Post::where('user_id', $user->id)->paginate(2);
        
        // dd($posts);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create() 
    {
        // dd('Creando Post...');

        return view('posts.create');
    }

    public function store(Request $request) 
    {
        // dd('Creando Publicacion...');

        $this->validate($request, [
            'titulo'      => 'required|max:255',
            'descripcion' => 'required',
            'imagen'      => 'required'
        ]);

        // Crear post 1 forma
        // en una misma instancia crea almacena y guarda
        // Post::create([
        //     'titulo'       => $request->titulo,
        //     'descripcion'  => $request->descripcion,
        //     'imagen'       => $request->imagen,
        //     'user_id'      => auth()->user()->id
        // ]);
      
        // Crear post 2 forma
        // crea instancia nueva llena la info y guarda en db
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        // Crear post 3 forma usando la relacion definida en el modelo 
        $request->user()->posts()->create([
            'titulo'       => $request->titulo,
            'descripcion'  => $request->descripcion,
            'imagen'       => $request->imagen,
            'user_id'      => auth()->user()->id
        ]);

        // Redireccionar al usuario
        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        dd('Eliminando ', $post->id);
    }
}
