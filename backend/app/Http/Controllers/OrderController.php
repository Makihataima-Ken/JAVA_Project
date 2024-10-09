<?php

namespace App\Http\Controllers;

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
    public function add_order(Request $request):JsonResponse
    {
        $user=Auth::user();

        // Validate the request data
        $request->validate([
            'university' => 'required|string|max:255',
            'major' => 'required|string',
            'type' => 'required|string',
            'description'=>'required|string|max:255',
            'deadline'=>'required|string',
        ]);

        // Create a new order instance with mass assignment
        $order = new Order(array_merge($request->only(['university', 'major', 'type', 'description', 'deadline']), [
            'status' => 'pending',
            'user_id' => $user->id,
        ]));

        $order->save();

        return response()->json(['message'=>'added an order','order'=>$order],201);

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
        return response()->json(['message'=>'order canceled']);
    }
}
