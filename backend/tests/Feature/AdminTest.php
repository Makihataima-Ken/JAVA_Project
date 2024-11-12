<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;

uses(RefreshDatabase::class);

//1st test
test('approve_order_validation', function () {

    $order = Order::factory()->create();

    $response = $this->postJson('/api/approve_order/'.$order->id);

    $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(['message' => 'order has been approved']);

    $this->assertDatabaseHas('orders', [
        'status' => 'in progress',
    ]);
});

//2nd test
test('reject_order_validation', function () {

    $order = Order::factory()->create();

    $response = $this->postJson('/api/reject_order/'.$order->id);

    $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(['message' => 'order has been rejected']);

    $this->assertDatabaseMissing('orders', [
        'id' => $order->id,
    ]);
});

//3rd test
test('pending_orders_view', function () {

    //-----------------------------------------------
    $orders = Order::factory()->count(2)->create(['status'=>'pending']); // create pending orders
    $order=Order::factory()->create(['status'=>'in progress']); // not a pending order
    //-----------------------------------------------

    //request to see orders
    $response = $this->get('/api/pending_orders');

    //make sure the respone is working
    $response->assertStatus(JsonResponse::HTTP_OK)
    ->assertJson([
        'success' => true,
        'message' => 'Pending Orders',
        'status_message' => 'HTTP_OK',
    ]);

    // Check that the returned data matches the user's orders
    $jsonOrders = $response->json('data');
    foreach ($jsonOrders as $index => $jsonOrder) {
        $order = $orders[$index];  // Get the corresponding Order model instance
 
        // Compare each field
        $this->assertEquals($order->id, $jsonOrder['id'], 'Order ID does not match.');
        $this->assertEquals($order->type, $jsonOrder['type'], 'Order type does not match.');
        $this->assertEquals($order->status, $jsonOrder['status'], 'Order status does not match.');
        $this->assertEquals($order->created_at->toJSON(), $jsonOrder['creation_date'], 'Order creation date does not match.');
    }
});
