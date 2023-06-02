<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:100',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
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
            return response(['msg' => 'wrong credentiels'], 401);
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
