<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Adds rental.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function rent(Request $request)
    {
        Rental::create(
            $request->validate(
                [
                    'user_id'     => 'required|numeric',
                    'movie_id'    => 'required|numeric',
                    'rental_date' => 'required|date',
                    'watched'     => 'required|date',
                    'note'        => 'required|numeric'
                ]
            )
        );
        
        return response()->json('The rental data successfully added.');
    }
}