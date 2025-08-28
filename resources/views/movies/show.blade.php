<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight truncate">
            {{ $movie['Title'] ?? 'Detalle' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="md:w-1/3 flex-shrink-0 mx-auto md:mx-0" style="max-width: 300px;">
                            <img src="{{ $movie['Poster'] !== 'NA' ? $movie['Poster'] : 'https://via.placeholder.com/300x450.png?text=No+Poster' }}" alt="Poster de {{ $movie['Title'] }}" class="rounded-lg shadow-lg w-full">
                        </div>
                        <div class="md:w-2/3">
                            <h1 class="text-3xl font-bold mb-2">{{ $movie['Title'] }} ({{ $movie['Year'] }})</h1>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ $movie['Rated'] }} | {{ $movie['Runtime'] }} | {{ $movie['Genre'] }}</p>

                            <div class="mb-4">
                                <h3 class="font-bold text-lg mb-1">Sinopsis</h3>
                                <p>{{ $movie['Plot'] }}</p>
                            </div>

                             <div class="mb-4">
                                <h3 class="font-bold text-lg mb-1">Actores</h3>
                                <p>{{ $movie['Actors'] }}</p>
                            </div>

                             <div class="mb-6">
                                <h3 class="font-bold text-lg mb-1">Rating IMDb</h3>
                                <p class="text-2xl font-mono">{{ $movie['imdbRating'] }} / 10</p>
                            </div>

                            @php
                                $movieInDb = App\Models\Movie::firstWhere('imdb_id', $movie['imdbID']);
                            @endphp

                            @if ($isFavorite)
                                <form action="{{ route('favorites.destroy', ['movie' => $movieInDb->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path></svg>
                                        Quitar de Favoritos
                                    </x-danger-button>
                                </form>
                            @else
                                 <form action="{{ route('favorites.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="imdb_id" value="{{ $movie['imdbID'] }}">
                                    <x-primary-button>
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.5l1.318-1.182a4.5 4.5 0 116.364 6.364L12 18.75l-7.682-7.682a4.5 4.5 0 010-6.364z"></path></svg>
                                        Añadir a Favoritos
                                    </x-primary-button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>