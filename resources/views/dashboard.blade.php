<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Buscador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-gray-800 dark:text-gray-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg  font-medium mb-4">Buscar Películas</h3>
                    <form action="{{ route('movies.search') }}" method="GET">
                        <div class="flex flex-col sm:flex-row gap-4 items-center">
                            <div class="flex-grow w-full sm:w-auto !text-black">
                                <x-text-input type="text" name="title" class="w-full" placeholder="Ej: The Matrix" value="{{ request('title') }}" required />
                            </div>
                            <div class="w-full sm:w-auto">
                                <x-text-input type="number" name="year" class="w-full" placeholder="Año (opcional)" value="{{ request('year') }}" />
                            </div>
                            <x-primary-button class="w-full sm:w-auto justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                Buscar
                            </x-primary-button>
                        </div>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </form>

                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </form>

                @if(session('error'))
                    <div class="mt-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                        <strong>Error de la API:</strong> {{ session('error') }}
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>