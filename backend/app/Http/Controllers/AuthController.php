<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {   
        //validation
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email' => 'required|stirng|email|unique:users',
            'phone'=>'required|string|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);
        //wrong input
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 422);
        }
        //register user
        $user=User::create(array_merge([$validator->validated(),'password'=>bcrypt($request->password)]));

        return response()->json(['message'=>'registered successfully','user'=>$user],201);

    }
}
