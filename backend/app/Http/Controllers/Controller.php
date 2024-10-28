<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

abstract class Controller 
{   
    /**
     * send regular response
     * @param $message
     * @param $data
     * @param $statuscode
     * @return JsonResponse
     */
    public function send($message,$data,$statusMessage,$statuscode):JsonResponse
    {
        return response()->json([
            'success'=>true,
            'message'=>$message,
            'data'=>$data,
            'status_message'=>$statusMessage,
        ],$statuscode);
    }

    /**
     * send error response
     * @param $message
     * @param $errors
     * @param $statuscode
     * @return JsonResponse
     */
    public function error($message,$errors,$statusMessage,$statuscode):JsonResponse
    {
        return response()->json([
            'success'=>false,
            'message'=>$message,
            'errors'=>$errors,
            'status_message'=>$statusMessage,
        ],$statuscode);
    }

      /**
     * token generator
     * @param $token
     * @param $word
     * @param $user
     * @param $statusCode
     * @return JsonResponse
     */
    public function createNewToken($token,$word,$user,$statusMessage,$statusCode):JsonResponse
    {   
        $message=$word.' successfully';
        $data=[
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>Auth::factory()->getTTl()*60,
            'user'=>$user,
        ];
        if($user->usertype=='admin'){
            //intiate a list of all orders
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

        return $this->send($message,$data,$statusMessage,$statusCode);
    }
}
