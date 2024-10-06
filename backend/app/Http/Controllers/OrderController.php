<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function add_post(Request $request):JsonResponse
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

        // Create a new post instance with mass assignment
        $order = new Order([
            'university' => $request->university,
            'major'=>$request->major,
            'type'=>$request->type,
            'description' => $request->description,
            'deadline'=>$request->deadline,
            'status' => 'pending',
            'user_id' => $user->id,
        ]);

        $order->save();

        return response()->json(['message'=>'added an order','order'=>$order],201);

    }
}
