<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;


abstract class Controller 
{
    public function pass($success,$message,$data=null,$statuscode):JsonResponse
    {
        return response()->json([
            'success'=>$success,
            'message'=>$message,
            'data'=>$data,
        ],$statuscode);
    }

    public function error($success,$message,$errors=null,$statuscode):JsonResponse
    {
        return response()->json([
            'success'=>$success,
            'message'=>$message,
            'errors'=>$errors,
        ],$statuscode);
    }
}
