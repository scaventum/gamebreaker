<?php

use Illuminate\Http\Request;

use App\Game;
use App\Http\Resources\Game as GameResource;

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

//List games
Route::get('games/{item_per_page?}', 'GamesController@api_list');
