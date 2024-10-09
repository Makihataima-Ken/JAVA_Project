<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function approve_order($id):JsonResponse
    {
        $order=Order::find($id);
        $order->status='approved';
        $order->save();
        return response()->json(['message'=>'order has been approved'],JsonResponse::HTTP_OK);
    }

    public function reject_order($id):JsonResponse
    {
        $order=Order::find($id);
        $order->status='rejected';
        $order->save();
        return response()->json(['message'=>'order has been rejected'],JsonResponse::HTTP_OK);
    }
}
