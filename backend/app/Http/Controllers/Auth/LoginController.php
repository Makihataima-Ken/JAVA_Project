<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;


class LoginController extends Controller
{
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
            return $this->error('Invalid Credentials',$validator->errors(),'HTTP_UNPROCESSABLE_ENTITY',JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
        // Authentication attempt
        if(!$token=JWTAuth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password]))
        {
        return $this->error('unauthorized log in attempt',null,'HTTP_UNAUTHORIZED',JsonResponse::HTTP_UNAUTHORIZED);
        }
        // Generate token if authentication succeeds
        return $this->createNewToken($token,'logged in',Auth::user(),'HTTP_OK',JsonResponse::HTTP_OK);
    }

}
