<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            Resultados de Búsqueda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if(isset($movies) && $movies->count())
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($movies as $movie)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col transform hover:scale-105 transition-transform duration-300">
                            <a href="{{ route('movies.show', $movie['imdbID']) }}" class="flex flex-col h-full">

                                <div class="w-full flex-shrink-0">
                                    <img src="{{ $movie['Poster'] !== 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x450.png?text=No+Poster' }}"
                                        alt="Poster de {{ $movie['Title'] }}"
                                        class="w-full h-auto object-cover aspect-[2/3]">
                                </div>

                                <div class="p-4 flex flex-col flex-grow">
                                    <h3 class="font-bold text-gray-900 dark:text-white truncate" title="{{ $movie['Title'] }}">{{ $movie['Title'] }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400 mt-auto pt-2">{{ $movie['Year'] }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8 flex flex-col items-center space-y-4">
                    {{ $movies->links() }}
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        No se encontraron resultados para tu búsqueda.
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>