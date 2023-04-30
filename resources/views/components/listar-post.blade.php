<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">                  
            @foreach ( $posts as $post )
                <div>              
                    {{-- $post->user: es la persona que escribio ese post  --}}
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach            
        </div>
        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    @else
        <p class="text-center">No hay Posts, sigue a alguien para poder mostrar sus posts</p>
    @endif

    {{-- otra forma --}}
    {{-- @forelse ($posts as $post )
        <h1>{{ $post->titulo }}</h1>
    @empty
        <p>No hay Posts</p>
    @endforelse --}}
</div>