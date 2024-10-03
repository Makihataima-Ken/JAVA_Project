<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {   
        //validation
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'lastname'=>'required|string',
            'phone'=>'required|string|min:10|max:10|unique:users,phone',
            'password' => 'required|string|confirmed|min:8',
        ]);
        //wrong input
        if ($validator->fails()) {
            return response()->json([
                            'success' => false,
                            'message' => 'Validation errors',
                            'errors' => $validator->errors()], 400);
        }

        //register user
        $user=User::create(array_merge([$validator->validated(),'password'=>bcrypt($request->password)]));

        return response()->json(['message'=>'registered successfully','user'=>$user],201);

    }

    public function login(Request $request)
    {
        //validation
        $validator = Validator::make($request->all(), [
            'phone'=>'required|string|exists:users,phone',
            'password' => 'required|string|min:8',
        ]);
        //wrong input
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // Authentication attempt
        if(!$token=Auth::attempt($validator->validated()))
        {
        return response()->json(['error'=>'unauthorized'],401);
        }
        // Generate token if authentication succeeds
        return $this->createNewToken($token);
    }

    public function createNewToken($token)
    {
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>Auth::factory()->getTTl()*60,
            'user'=>Auth::user(),
        ]);
    }

    public function profile()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message'=>'logged out successfully']);
    }
}
