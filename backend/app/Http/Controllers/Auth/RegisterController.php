<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    /**
     * register user
     * @param $request
     * @return JsonResponse
     */
    public function register(Request $request):JsonResponse
    {   
        //validation
        $validator = Validator::make($request->all(), [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'phone_number'=>'required|string|min:10|max:10|unique:users,phone',
            'password' => 'required|string|confirmed|min:8',
        ]);
        
        //wrong input
        if ($validator->fails()) {
            return $this->error('Validation errors',$validator->errors(), 400);
        }

        //register user
        $user=User::create(array_merge($validator->validated(),['password'=>bcrypt($request->password),'usertype'=>'user']));

        $user->save();

        // Generate a JWT token for the user
        $token = JWTAuth::fromUser($user);

        return $this->createNewToken($token,'Registered',$user,201);

    }
}
