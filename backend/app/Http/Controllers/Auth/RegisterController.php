<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
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
            return $this->error('Validation errors',$validator->errors(), 'HTTP_BAD_REQUEST',JsonResponse::HTTP_BAD_REQUEST);
        }

        //register user
        $user=User::create(array_merge($validator->validated(),['password'=>bcrypt($request->password),'usertype'=>'user']));

        $user->save();
        try{
        // Generate a JWT token for the user
        $token = JWTAuth::fromUser($user);
        }catch (JWTException $e) {
            return $this->error('could_not_create_token',$e,'HTTP_INTERNAL_SERVER_ERROR',JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        // create data package for the UI
        $data=[
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>Auth::factory()->getTTl()*60,
            'user'=>$user,
        ];
        //send the json response
        return $this->send('Registered successfully',$data,'HTTP_CREATED',JsonResponse::HTTP_CREATED);

    }
}
