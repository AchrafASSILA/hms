<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);
        $token =  $user->createToken('token')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
        ], 201);
    }
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|',
        ]);
        // check email 
        $user = User::where('email', $fields['email'])->first();
        // check password 
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['msg' => 'wrong credentiels'], 200);
        }
        $token =  $user->createToken('token')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token,
        ], 201);
    }
    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();
        return response(['msg' => 'logout success'], 200);
    }
    public function updateProfile(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
        ]);
        $user = Auth::user();
        $user->name  = $fields['name'];
        $user->save();

        return response('', 200);
    }
}
