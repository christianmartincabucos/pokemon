<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    private $user;
    private $request;
    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }   

    public function register()
    {
        $validatedData = $this->request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'birthday'      => 'required|string|max:255|date_format:Y-m-d',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:8',
        ]);
        $user = $this->user->create([
            'first_name'=> $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'birthday'  => $validatedData['birthday'],
            'email'     => $validatedData['email'],
            'password'  => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            "message" => true,
        ]);
    }
    public function update()
    {
        $user = $this->user->findOrfail($this->request->id)->first();
        $user->update($this->request->all());
        return response()->json([
            'user' => $user,
            "message" => true,
        ]);
    }

    public function fetchUsers(){
        $users = $this->user->all();
        return $users;
    }

}
