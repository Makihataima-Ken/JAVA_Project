<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;

uses(RefreshDatabase::class);

//1st test
test('order_fruition', function () {

    // Create a user and authenticate
    $user = User::create([
        'name' => 'J3fr',
        'lastname' => 'ma7fud',
        'phone' => '1234567890', 
        'password' => bcrypt('validpassword'),  // Encrypt password
    ]);
    $this->actingAs($user);

    //makes a test order
    $response = $this->postJson('/api/add_order', [
        'university' => 'Damas',
        'major' => 'med',
        'type' => 'grad pro',
        'description'=>'smth smth',
        'deadline'=>'1/8/2024',
    ]);

    //make sure the respone is working
    $response->assertStatus(JsonResponse::HTTP_CREATED)
    ->assertJson([
        'message' => 'added an order',
        'order' => [
            'university' => 'Damas',
            'major' => 'med',
            'type' => 'grad pro',
            'description'=>'smth smth',
            'deadline'=>'1/8/2024',
            'status'=>'pending',
        ],
    ]);
    //check for order's record in database
    $this->assertDatabaseHas('orders');
});

//2nd test
test('cancel_order_fruition', function () {

    // Create a user and authenticate
    $order = Order::create([
        'university' => 'Damas',
        'major' => 'med',
        'type' => 'grad pro',
        'description'=>'smth smth',
        'deadline'=>'1/8/2024',
    ]);

    //makes a test order
    $response = $this->deleteJson('/api/cancel_order/'.$order->id);

    //make sure the respone is working
    $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(['message' => 'order canceled']);


});
