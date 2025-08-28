<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovieApiService;

class MovieController extends Controller
{
    protected $movieApiService;

    public function __construct(MovieApiService $movieApiService)
    {
        $this->movieApiService = $movieApiService;
    }

    public function search(Request $request)
    {
        $request->validate(['q' => 'required|string']);
        $results = $this->movieApiService->search($request->q, $request->year);
        return response()->json($results);
    }

    public function show($id)
    {
        $movie = $this->movieApiService->findById($id);
        return response()->json($movie);
    }
}