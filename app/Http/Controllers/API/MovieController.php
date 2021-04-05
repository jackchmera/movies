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
        // Model::all has been overwritten by Movie model.
        return $movies = Movie::all();
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
        $movie = new Movie([
            'title'        => $request->input('title'),
            'release_year' => $request->input('release_year'),
            'cover'        => $request->input('cover')
        ]);
        $movie->save();
        
        return response()->json('The movie successfully added');
    }

    /**
     * Gets movie data.
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function edit(int $id)
    {
        $movie = Movie::find($id);
        return response()->json($movie);
    }

    /**
     * Updates movie.
     * 
     * @param int       $id
     * @param Request   $request
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function update(int $id, Request $request)
    {
        $movie = Movie::find($id);
        $movie->update($request->all());

        return response()->json('The movie successfully updated');
    }

    /**
     * Deletes movie.
     * 
     * @param  int $id
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function delete(int $id)
    {
        $movie = Movie::find($id);
        $movie->delete();

        return response()->json('The movie successfully deleted');
    }
}