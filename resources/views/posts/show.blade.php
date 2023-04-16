@extends('layouts.app')

@section('titulo')
   {{ $post->titulo }}
@endsection

@section('contenido')
   <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">

            <div class="p-3">
                <p>0 Likes</p>
            </div>

            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">
                    {{-- formato a la fecha --}}
                    {{ $post->created_at->diffForHumans() }}
                </p>
                <p class="mt-5">
                    {{ $post->descripcion }}
                </p>
            </div>
            
            {{-- revisar que este autenticado --}}
            @auth
                {{-- comprobar la persona autenticada es la misma q creo el post? --}}
                @if ( $post->user_id === auth()->user()->id )
                    {{-- si es la misma muestra el boton de eliminar publicacion  --}}
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        @method('DELETE') {{-- METHOD SPOOFING: permite agregar otras peticiones como put path delete al navegador ya que este soporta nativamente post y get --}}
                        @csrf
                        <input 
                            type="submit"
                            value="Eliminando Publicación" 
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                        >
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            {{-- shadow = sombra --}}
            <div class="shadow bg-white p-5 mb-5">                
                {{-- verifica que el usuario este auteticado para mostar p y form --}}
                @auth
                <p class="text-xl font-bold text-center mb-4">
                    Agrega un Nuevo Comentario
                </p>

                @if (session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{ session('mensaje') }}
                    </div>
                @endif

                <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Añade un Comentario
                        </label>
                        <textarea 
                            id="comentario"
                            name="comentario"                        
                            placeholder="Agrega un Comentario"                       
                            class="border p-3 w-full rounded-lg @error('name') border-red-500 
                            @enderror"                 
                        ></textarea>
    
                       
                        @error('comentario')                      
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <input 
                        type="submit"
                        value="Comentar"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg
                        "
                    >
                </form>

                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    {{-- {{ dd($post->comentarios) }} --}}
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario )
                            <div class="p-5 border-gray-300 border-b">
                                {{-- podemos ir al muro del usuario que comento el post --}}
                                <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">
                                    {{ $comentario->user->username }}
                                </a>
                                <p>{{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No Hay Comentarios Aún</p>
                    @endif
                </div>
            </div>
        </div>
   </div>
@endsection