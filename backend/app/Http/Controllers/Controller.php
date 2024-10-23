<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;


abstract class Controller 
{   
    /**
     * send pass rresponse
     * @param $success
     * @param $message
     * @param $data
     * @param $statuscode
     * @return JsonResponse
     */
    public function pass($success,$message,$data=null,$statuscode):JsonResponse
    {
        return response()->json([
            'success'=>$success,
            'message'=>$message,
            'data'=>$data,
        ],$statuscode);
    }

    /**
     * send pass rresponse
     * @param $success
     * @param $message
     * @param $errors
     * @param $statuscode
     * @return JsonResponse
     */
    public function error($success,$message,$errors=null,$statuscode):JsonResponse
    {
        return response()->json([
            'success'=>$success,
            'message'=>$message,
            'errors'=>$errors,
        ],$statuscode);
    }
}
