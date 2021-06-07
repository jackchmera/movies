<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'release_year', 'cover'];
    
    /**
     * Retrieves all movies and respective avg note.
     *
     * @return array
     */
    public static function getAllMoviesAndNotes() : array
    {
        return Movie::select(
            'movies.id',
            'movies.title',
            'movies.release_year',
            'movies.cover',
            DB::raw('avg(rentals.note) as avg_note')
        )
            ->leftJoin('rentals', 'movies.id', '=', 'rentals.movie_id')
            ->groupBy('movies.id')
            ->get()
            ->toArray();
    }
}
