<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;


abstract class Controller 
{   
    /**
     * send pass rresponse
     * @param $message
     * @param $data
     * @param $statuscode
     * @return JsonResponse
     */
    public function send($message,$data,$statuscode):JsonResponse
    {
        return response()->json([
            'success'=>true,
            'message'=>$message,
            'data'=>$data,
        ],$statuscode);
    }

    /**
     * send pass rresponse
     * @param $message
     * @param $errors
     * @param $statuscode
     * @return JsonResponse
     */
    public function error($message,$errors,$statuscode):JsonResponse
    {
        return response()->json([
            'success'=>false,
            'message'=>$message,
            'errors'=>$errors,
        ],$statuscode);
    }
}
