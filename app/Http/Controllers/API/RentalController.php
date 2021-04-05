<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Add rental.
     * 
     * @param  int      $movieId
     * @param  int      $userId
     * @param  Request  $request
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function rent(int $movieId, int $userId, Request $request)
    {   
        $rental              = new Rental();
        $rental->user_id     = $userId;
        $rental->movie_id    = $movieId;
        $rental->rental_date = $request->rental_date;
        $rental->watched     = $request->watched;
        $rental->note        = $request->note;
        $rental->save();
        
        return response()->json('The rental data successfully added');
    }
    
//    public function getAverageNote($id)
//    {
//        $averageNote = DB::table('rental')
//            ->where(['user_id' => $id])
//            ->avg('note');
//        
//        return $averageNote;
//    }
}