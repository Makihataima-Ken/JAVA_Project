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

    /**
     * login user
     * @param $request
     * @return JsonResponse
     */
    public function login(Request $request):JsonResponse
    {
        //validation
        $validator = Validator::make($request->all(), [
            'phone_number'=>'required|string|exists:users,phone_number',
            'password' => 'required|string|min:8',
        ]);
        //wrong input
        if ($validator->fails()) {
            return $this->error('Invalid Credentials',$validator->errors(), 422);
        }
        // Authentication attempt
        if(!$token=JWTAuth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password]))
        {
        return $this->error('unauthorized',null,401);
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
        $message=$word.' successfully';
        $data=[
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>Auth::factory()->getTTl()*60,
            'user'=>$user,
        ];
        if($user->usertype=='admin'){
            //intiate a list od all orders
            $orders=Order::all();

            //take basic info from 'em
            foreach ($orders as $order) {

                $orders_preview[]=[
                    'id'=>$order->id,
                    'user_id'=>$order->user_id,
                    'university'=>$order->university,
                    'major'=>$order->major,
                    'type'=>$order->type,
                ];
            }
            $data[]=$orders_preview;
        }

        return $this->send($message,$data,$statusCode);
    }

    /**
     * show profile
     * @return JsonResponse
     */
    public function profile():JsonResponse
    {
        return $this->send('User Profile',Auth::user(),200);
    }

    /**
     * logout user
     * @return JsonResponse
     */
    public function logout():JsonResponse
    {
        Auth::logout();
        return $this->send('logged out successfully',null,200);
    }
}
