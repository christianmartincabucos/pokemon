<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;
use Illuminate\Support\Facades\DB;

class PokemonController extends Controller
{
    private $pokemon;
    public function __construct(Pokemon $pokemon)
    {
        $this->pokemon = $pokemon;
    }

    public function fetchLikedbyUser($user_id){
        return $pokemons = $this->pokemon->where(['user_id' => $user_id, 'status' => 'liked'])->get();
    }

    public function fetchHatedbyUser($user_id){
        return $pokemons = $this->pokemon->where(['user_id' => $user_id, 'status' => 'hated'])->get();
    }

    public function fetchPokemonsbyStatus($user_id, $status){
        return $this->pokemon::where(['user_id' => $user_id, 'status' => $status])->get();
    }

    public function pokemonHatedLiked(Request $request){
        $pokemon = $this->pokemon->create($request->pokemon);
        return response()->json([
            'pokemon' => $pokemon,
            'message' => true
        ], 200);
    }

    
    public function checkIfLiked($poke_id){
        $likedPokemon = $this->pokemon::where("id", $poke_id)->get();

        if($likedPokemon->count() > 0 ){
            return true;
        }

        return false;
    }

    public function checkIfHated($poke_id){
        $hatedPokemon = $this->pokemon::where("id", $poke_id)->get();

        if($hatedPokemon->count() > 0 ){
            return true;
        }
        return false;
    }

}
