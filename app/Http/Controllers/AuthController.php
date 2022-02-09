<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginAuthRequest;

class AuthController extends Controller
{
    protected $user;
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->user = $this->guard()->user();
    }

    public function login(LoginAuthRequest $request){
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid Credientials'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function profile(){
        return response()->json(auth()->user());
    }
    
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully logged out.']);
    }

    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    public function guard(){
        return Auth::guard();
    }
}
