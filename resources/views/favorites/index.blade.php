<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            Mis Películas Favoritas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if($favorites->count())
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($favorites as $movie)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col transform hover:scale-105 transition-transform duration-300">
                            <a href="{{ route('movies.show', $movie->imdb_id) }}" class="flex flex-col h-full">

                                <div class="w-full flex-shrink-0 relative">
                                    <img src="{{ $movie->poster_url ?? 'https://via.placeholder.com/300x450.png?text=No+Poster' }}"
                                        alt="Poster de {{ $movie->title }}"
                                        class="w-full h-auto object-cover aspect-[2/3]">
                                    <div class="absolute top-2 right-2">
                                        <form action="{{ route('favorites.destroy', $movie) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white bg-red-600 bg-opacity-75 hover:bg-opacity-100 rounded-full p-2 transition-transform hover:scale-110">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="p-4 flex flex-col flex-grow">
                                    <h3 class="font-bold text-gray-900 dark:text-white truncate" title="{{ $movie->title }}">{{ $movie->title }}</h3>
                                    <p class="text-gray-600 dark:text-gray-400 mt-auto pt-2">{{ $movie->year }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8 flex flex-col items-center space-y-4">
                    {{ $favorites->links() }}
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <p class="p-6 text-gray-900 dark:text-gray-100">Aún no tienes películas en tu lista de favoritos.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>