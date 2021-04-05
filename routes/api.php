<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\RentalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'movies'], function () {
    Route::get('/', [MovieController::class, 'index']);
    Route::post('add', [MovieController::class, 'add']);
    Route::get('edit/{id}', [MovieController::class, 'edit']);
    Route::post('update/{id}', [MovieController::class, 'update']);
    Route::delete('delete/{id}', [MovieController::class, 'delete']);
    Route::post('rent/{id}/{user}', [RentalController::class, 'rent']);
});
