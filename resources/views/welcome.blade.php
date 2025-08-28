<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-t">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Movie Finder</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .gradient-overlay {
                background: linear-gradient(to top, rgba(17, 24, 39, 1) 0%, rgba(17, 24, 39, 0.7) 50%, rgba(17, 24, 39, 0) 100%);
            }
        </style>
    </head>
    <body class="antialiased font-sans">
        <div class="bg-gray-900 text-white min-h-screen flex flex-col items-center justify-center relative">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1574267432553-4b4628081c31?q=80&w=1931&auto=format&fit=crop"
                     alt="Cinema background"
                     class="w-full h-full object-cover opacity-30">
                <div class="absolute inset-0 gradient-overlay"></div>
            </div>

            <div class="relative z-10 flex flex-col items-center justify-center text-center p-6">

                <main class="mt-12">
                    <div class="flex flex-col items-center">
                        <svg class="h-20 w-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                        </svg>

                        <h1 class="mt-6 text-4xl font-bold tracking-tight sm:text-5xl">
                            Movie Finder
                        </h1>
                        <p class="mt-4 text-lg text-gray-300">
                            Tu portal para descubrir, buscar y guardar tus películas favoritas.
                        </p>
                        <div class="mt-8 flex flex-col sm:flex-row gap-4">
                             @auth
                                {{-- Si el usuario está logueado, muestra un solo botón --}}
                                <a href="{{ url('/dashboard') }}" class="inline-block rounded-lg bg-red-600 px-5 py-3 text-base font-medium text-white shadow-lg transition hover:bg-red-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-900">
                                    Ir al Buscador &rarr;
                                </a>
                             @else
                                <a href="{{ route('login') }}" class="inline-block rounded-lg bg-red-600 px-5 py-3 text-base font-medium text-white shadow-lg transition hover:bg-red-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-900">
                                    Iniciar Sesión
                                </a>
                                <a href="{{ route('register') }}" class="inline-block rounded-lg bg-gray-700 px-5 py-3 text-base font-medium text-white shadow-lg transition hover:bg-gray-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-500 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-900">
                                    Registrarse
                                </a>
                             @endauth
                        </div>
                    </div>
                </main>

                <footer class="py-16 text-center text-sm text-gray-400 mt-auto pt-8">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </footer>
            </div>
        </div>
    </body>
</html>