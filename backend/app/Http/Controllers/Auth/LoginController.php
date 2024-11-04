<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class LoginController extends Controller
{
    /**
     * login user
     * @param $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request):JsonResponse
    {
        try{
        // Authentication attempt
        if(!$token=JWTAuth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password]))
        {
        return $this->error('unauthorized log in attempt',null,'HTTP_UNAUTHORIZED',JsonResponse::HTTP_UNAUTHORIZED);
        }
        }catch (JWTException $e) {
            return $this->error('could_not_create_token',$e,'HTTP_INTERNAL_SERVER_ERROR',JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        // Generate token if authentication succeeds
        $data=[
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>Auth::factory()->getTTl()*60,
            'user'=>Auth::user(),
        ];
        return $this->send('logged in successfully',$data,'HTTP_OK',JsonResponse::HTTP_OK);
    }

}
