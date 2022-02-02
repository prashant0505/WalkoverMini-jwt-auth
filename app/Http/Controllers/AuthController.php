<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'salary'=> 'required|integer|min:3',
            'company_id' => 'exists:companies,id'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>Hash::make($request->password),
                'salary'=>$request->salary,
                'company_id'=>$request->company_id,
            ]);
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
