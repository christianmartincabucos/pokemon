<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    // app/Http/Controllers/AuthController.php

    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(Request $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = $this->user->where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user,
            'token_type' => 'Bearer',
            'success' => true,
        ]);
    }

}
