<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        return response()->json($request->user()->favorites()->paginate(15));
    }

    // Este método único agrega o elimina una película de favoritos
    public function toggle(Request $request)
    {
        $request->validate(['imdb_id' => 'required|string']);
        $movie = Movie::firstOrCreate(
            ['imdb_id' => $request->imdb_id],
            ['title' => $request->title, 'year' => $request->year, 'poster_url' => $request->poster_url]
        );

        $result = $request->user()->favorites()->toggle($movie->id);
        $status = count($result['attached']) > 0 ? 'added' : 'removed';

        return response()->json(['status' => $status]);
    }
}