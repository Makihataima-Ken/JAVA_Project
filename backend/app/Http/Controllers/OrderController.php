<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{   
    /**
     * request orders
     * @param $request 
     * @return JsonResponse
     */
    public function add_order(OrderRequest $request):JsonResponse
    {
        $user=Auth::user();

        $filePath=null;

        if ($request->hasFile('file_path')){
            $filePath = $request->file('file_path')->store('uploads', 'public');
        }

        // Create a new order instance with mass assignment
        $order = new Order(array_merge($request->only(['university', 'major', 'type', 'description', 'deadline']), [
            'status' => 'pending',
            'user_id' => $user->id,
            'file_path'=>$filePath,
        ]));

        $order->save();

        return $this->send('added an order',$order,'HTTP_CREATED',JsonResponse::HTTP_CREATED);

    }

    /**
     * cancel orders
     * @param $id 
     * @return JsonResponse
     */
    public function cancel_order($id): JsonResponse
    {
        $order=Order::find($id);
        $order->delete();
        return $this->send('order canceled',null,'HTTP_OK',JsonResponse::HTTP_OK);
    }

    /**
     * show orders
     * @return JsonResponse
     */
    public function user_orders():JsonResponse
    {
        $user=Auth::user();
        $user_orders=Order::where('user_id',$user->id)->get();
        foreach($user_orders as $order)
        {
            $orders_overview[]=$order->createOrderOverview();
        }
        return $this->send('My Orders',$orders_overview,'HTTP_OK',JsonResponse::HTTP_OK);

    }

    /**
     * show order's details
     * @return JsonResponse
     */
    public function order_details($id):JsonResponse
    {
        
        $order=Order::find($id)->get();
        return $this->send('Order Details',$order,'HTTP_OK',JsonResponse::HTTP_OK);

    }
}
