<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DevStagram - @yield('titulo')</title>
        
        <!-- indicar que utilizamos vite con app.css -->
        @vite('resources/css/app.css')

    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            {{-- DevStangram centrado a la izq y lo que halla dentro del div se ubique del lado derecho centrado verticalmente --}}
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">
                    DevStangram
                </h1>

                {{-- Se ubica del lado derecho gracias a justify-between --}}
                {{-- gap para separar los enlaces; items-center para centrar verticalmente--}}
                <nav class="flex gap-2 items-center">
                    <a class="font-bold uppercase text-gray-600 text-sm" href="#">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="#">Crear Cuenta</a>
                </nav>
            </div>
        </header>

        {{-- inyecta dinamicamente cada informacion de las vistas --}}
        <main>

        </main>

        <footer>

        </footer>
        
    </body>
</html>