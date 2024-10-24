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
            'file_path' => 'nullable|mimes:pdf,doc,docx|max:2048'
        ]);

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

    /**
     * show orders
     * @return JsonResponse
     */
    public function user_orders():JsonResponse
    {
        $user=Auth::user();
        $user_orders=Order::where('user_id',$user->id)->get();
        return response()->json(['message'=>'My Orders','orders'=>$user_orders],200);

    }
}
