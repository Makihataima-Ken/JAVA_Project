<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{   
    /**
     * approve orders
     * @param $id 
     * @return JsonResponse
     */
    public function approve_order($id):JsonResponse
    {
        $order=Order::find($id);
        $order->status='in progress';
        $order->save();
        return response()->json(['message'=>'order has been approved'],JsonResponse::HTTP_OK);
    }

    /**
     * reject orders
     * @param $id 
     * @return JsonResponse
     */
    public function reject_order($id):JsonResponse
    {
        $order=Order::find($id);
        $order->delete();
        return response()->json(['message'=>'order has been rejected'],JsonResponse::HTTP_OK);
    }

    /**
     * show pending orders
     * @return JsonResponse
     */
    public function pending_orders():JsonResponse
    {
        
        $pending_orders=Order::where('status','pending')->get();
        foreach($pending_orders as $order)
        {
            $orders_overview[]=$order->createOrderOverview();
        }
        return $this->send('Pending Orders',$orders_overview,'HTTP_OK',JsonResponse::HTTP_OK);

    }
}
