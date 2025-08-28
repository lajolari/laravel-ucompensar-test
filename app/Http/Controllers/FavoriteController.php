<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Services\MovieApiService;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $favorites = $request->user()->favorites()->orderBy('title')->paginate(12);
        return view('favorites.index', compact('favorites'));
    }

    public function store(Request $request, MovieApiService $movieApiService)
    {
        $request->validate(['imdb_id' => 'required|string']);
        $user = $request->user();

        // Busca si la película ya existe en nuestra BD local
        $movie = Movie::firstWhere('imdb_id', $request->imdb_id);

        // Si no existe, la obtenemos de la API y la guardamos
        if (!$movie) {
            $movieData = $movieApiService->findById($request->imdb_id);
            if (isset($movieData['error'])) {
                return back()->with('error', $movieData['error']);
            }

            $movie = Movie::create([
                'imdb_id'    => $movieData['imdbID'],
                'title'      => $movieData['Title'],
                'year'       => $movieData['Year'],
                'poster_url' => $movieData['Poster'] !== 'N/A' ? $movieData['Poster'] : null,
            ]);
        }

        // Añadir a favoritos (attach no añadirá duplicados)
        $user->favorites()->syncWithoutDetaching([$movie->id]);

        return back()->with('success', 'Película añadida a favoritos.');
    }

    public function destroy(Request $request, Movie $movie)
    {
        $request->user()->favorites()->detach($movie->id);
        return back()->with('success', 'Película eliminada de favoritos.');
    }
}