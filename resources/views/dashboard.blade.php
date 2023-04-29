@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->username }} 
@endsection

@section('contenido')
    <div class="flex justify-center">
        {{-- w-full toma todo el ancho de un disp pequeño --}}
        {{-- md:w-8/12 disp mediando --}}
        {{-- md:w-6/12 disp largo toma 6 de 12 columnas --}}
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ 
                    $user->imagen ? //si cumple la condicion
                    asset('perfiles') . '/' . $user->imagen : // ejecuta el primer asset sino el segundo asset
                    asset('img/usuario.svg') }}" 
                    alt="imagen usuario"
                >
            </div>
            <div class="w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                {{-- flex: posiciona de izq a der, username luego el lapiz de edicion --}}
                <div class="flex items-center gap-2">
                    {{-- {{ dd($user) }} --}}
                    <p class="text-gray-700 text-2xl">{{ $user->username }}</p>
                    {{-- si el perfil actual es el mismo de la persona q esta autenticada  --}}
                    @auth
                        {{-- si es igual al usuario que esta autenticado --}}
                        @if($user->id === auth()->user()->id)
                            {{-- mostramos el enlace para que pueda modificar su perfil --}}
                            <a 
                                href="{{ route('perfil.index') }}"
                                class="text-gray-500 hover:text-gray-600 cursor-pointer"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                </svg>                              
                            </a>
                        @endif
                    @endauth
                </div>
            
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->followers->count() }}
                    {{-- en base a la cantidad de seguidores muestra seguidor o seguidores --}}
                    <span class="font-normal"> @choice('Seguidor|Seguidores', $user->followers->count() )  </span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal"> Siguiendo</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal"> Posts</span>
                </p>
                
                {{-- Puden seguir usuarios autenticados --}}
                @auth 
                    @if($user->id !== auth()->user()->id)
                        {{-- $user: es la persona que estamos visitando su perfil --}}
                        {{-- auth()->user: el usuario que lo esta visitando --}}
                        {{-- !$user->siguiendo( auth()->user(): esta persona no es seguidor, entoces siguelo  --}}
                        @if ( !$user->siguiendo( auth()->user() ))                           
                        
                            {{-- Seguir --}}                    
                            <form 
                                {{-- $user: es el usuario al cual estamos visitando su perfil --}}                       
                                action="{{ route('users.follow', $user) }}"
                                method="POST"
                            >
                                @csrf
                                <input 
                                    type="submit"
                                    class="bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Seguir"    
                                >
                            </form>
                        @else    
                            {{-- Dejar de seguir --}}
                            <form 
                                action="{{ route('users.unfollow', $user) }}"
                                method="POST"
                            >
                                @csrf                            
                                @method('DELETE') {{-- porque el nav solo soporta get o post --}}
                                <input 
                                    type="submit"
                                    class="bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer"
                                    value="Dejar de Seguir"    
                                >
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>            
        {{-- para mostrar las publicaciones --}}
        @if($posts->count())
            {{-- Para las imagenes --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">            
                {{-- {{ dd($posts) }} --}} <!-- es un arreglo para iterar usar foreach -->
                @foreach ( $posts as $post )
                    <div>
                        {{-- <a href="{{ route('posts.show', $post) }}"> --}}
                        <a href="{{ route('posts.show', ['post' => $post, 'user' => $user]) }}">
                            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                        </a>
                    </div>
                @endforeach            
            </div>
            <div class="my-10">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts</p>
        @endif
    </section>
@endsection