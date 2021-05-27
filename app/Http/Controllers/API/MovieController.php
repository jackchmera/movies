<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Get all movies and avg note.
     * 
     * @return array
     */
    public function index() : array
    {
        return Movie::getAllMoviesAndNotes();
    }

    /**
     * Inserts a new movie.
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function add(Request $request)
    {
        Movie::create($request->validate([
            'title'        => 'required|string',
            'release_year' => 'required|numeric',
            'cover'        => 'required|url'
        ]));
        
        return response()->json('The movie successfully added.');
    }

    /**
     * Gets movie data to edit.
     * 
     * @param Movie $movie
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function edit(Movie $movie)
    {
        return response()->json($movie);
    }

    /**
     * Updates movie.
     * 
     * @param Movie   $movie
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function update(Movie $movie, Request $request)
    {
        $movie->update($request->validate([
            'title'        => 'required|string',
            'release_year' => 'required|numeric',
            'cover'        => 'required|url'
        ]));
        
        return response()->json('The movie successfully updated.');
    }

    /**
     * Deletes movie.
     * 
     * @param Movie $movie
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function delete(Movie $movie)
    {
        $movie->delete();
        return response()->json('The movie successfully deleted.');
    }
}