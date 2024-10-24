<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
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
        $user=User::create(array_merge($validator->validated(),['password'=>bcrypt($request->password),'usertype'=>'user']));

        $user->save();

        // Generate a JWT token for the user
        $token = JWTAuth::fromUser($user);

        return $this->createNewToken($token,'Registered',$user,201);

    }

    /**
     * login user
     * @param $request
     * @return JsonResponse
     */
    public function login(Request $request):JsonResponse
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
        if(!$token=JWTAuth::attempt(['phone' => $request->phone, 'password' => $request->password]))
        {
        return response()->json(['error'=>'unauthorized'],401);
        }
        // Generate token if authentication succeeds
        return $this->createNewToken($token,'logged in',Auth::user(),200);
    }

    /**
     * token generator
     * @param $token
     * @param $word
     * @param $user
     * @param $statusCode
     * @return JsonResponse
     */
    public function createNewToken($token,$word,$user,$statusCode):JsonResponse
    {   
        if($user->usertype=='admin'){
            return response()->json([
                'success' => true,
                'message'=>'logged in successfully',
                'access_token'=>$token,
                'token_type'=>'bearer',
                'expires_in'=>Auth::factory()->getTTl()*60,
                'user'=>Auth::user(),
                'orders'=>Order::all(),
            ],$statusCode);
        }

        return response()->json([
            'success' => true,
            'message'=> $word.' successfully',
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>Auth::factory()->getTTl()*60,
            'user'=>$user->toArray(),
        ],$statusCode);
    }

    /**
     * show profile
     * @return JsonResponse
     */
    public function profile():JsonResponse
    {
        return response()->json(Auth::user());
    }

    /**
     * logout user
     * @return JsonResponse
     */
    public function logout():JsonResponse
    {
        Auth::logout();
        return response()->json(['message'=>'logged out successfully']);
    }
}
