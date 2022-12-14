<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PokemonController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::post('login', [LoginController::class, 'login']);
Route::post('register', [RegisterController::class, 'register']);
Route::post('/uses', [RegisterController::class, 'fetchUsers']);
Route::post('logout', [LogoutController::class, 'logout']);

Route::prefix('/pokemons')->group(function(){
    Route::get('/hated/{user_id}/{status}', [PokemonController::class, 'fetchPokemonsbyStatus']);;
    Route::get('/liked/{user_id}/{status}', [PokemonController::class, 'fetchPokemonsbyStatus']);;
    Route::post('/pokemon-hated-liked', [PokemonController::class, 'pokemonHatedLiked']);
    Route::get('/checkLike/{poke_id}', [PokemonController::class, 'checkIfLiked']);
    Route::get('/checkHate/{poke_id}', [PokemonController::class, 'checkIfHated']);
});

Route::prefix('/users')->group(function(){
    Route::get('/',[RegisterController::class, 'fetchUsers']);
    Route::post('/update/{id}', [RegisterController::class, 'update']);
    Route::get('/fetchLikes/{user_id}', [PokemonController::class, 'fetchLikedbyUser']);
    Route::get('/fetchHates/{user_id}', [PokemonController::class, 'fetchHatedbyUser']);
});

