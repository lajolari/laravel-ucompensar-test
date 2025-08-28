<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieApiService;
use Illuminate\Pagination\LengthAwarePaginator;

class MovieController extends Controller
{
    protected $movieApiService;

    public function __construct(MovieApiService $movieApiService)
    {
        $this->movieApiService = $movieApiService;
    }

    public function search(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:2',
            'year' => 'nullable|integer|digits:4' // Añadimos validación para el año
        ]);

        $title = $request->input('title');
        $year = $request->input('year');
        $page = $request->input('page', 1);

        $results = $this->movieApiService->search($title, $year, $page);

        // Si la API devuelve un error, volvemos al dashboard con un mensaje
        if (isset($results['error'])) {
            return redirect()->route('dashboard')->with('error', $results['error']);
        }

        // Si la búsqueda no tiene resultados, también lo manejamos
        if (empty($results['Search'])) {
            return redirect()->route('dashboard')->with('error', 'No se encontraron películas con ese título.');
        }

        // Creamos la paginación
        $movies = new LengthAwarePaginator(
            $results['Search'],
            (int) ($results['totalResults'] ?? 0),
            10, // OMDb devuelve 10 por página
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Si todo va bien, mostramos la vista de resultados
        return view('movies.search', compact('movies'));
    }

    public function show(Request $request, string $id)
    {
        $movie = $this->movieApiService->findById($id);

        if (isset($movie['error'])) {
            return redirect()->route('dashboard')->with('error', $movie['error']);
        }

        $isFavorite = $request->user()->favorites()->where('imdb_id', $id)->exists();

        return view('movies.show', compact('movie', 'isFavorite'));
    }
}