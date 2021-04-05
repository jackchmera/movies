<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTimeInterface;

class Movie extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title', 'release_year', 'cover'
    ];
    
    /**
    * Prepare a date for array / JSON serialization.
    *
    * @param  \DateTimeInterface  $date
     * 
    * @return string
    */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    
    /**
     * Retrieves all movies and respective avg note.
     * 
     * @param array | string    $columns
     * 
     * @override
     * 
     * @return array
     */
    public static function all($columns = ['*']) : array
    {
        return DB::table('movies')
            ->select('movies.id', 'movies.title', 'movies.release_year', 'movies.cover', DB::raw('avg(rentals.note) as avg_note'))
            ->leftJoin('rentals', 'movies.id', '=', 'rentals.movie_id')
            ->groupBy('movies.id')
            ->get()
            ->toArray();
    }
}
