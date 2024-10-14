<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;

uses(RefreshDatabase::class);

//1st test
test('approve_order_validation', function () {

    $order = Order::create([
        'university' => 'Damas',
        'major' => 'med',
        'type' => 'grad pro',
        'description'=>'smth smth',
        'deadline'=>'1/8/2024',
        'status'=>'pending',
    ]);

    $response = $this->postJson('/api/approve_order/'.$order->id);

    $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(['message' => 'order has been approved']);

    $this->assertDatabaseHas('orders', [
        'status' => 'approved',
    ]);
});

//2nd test
test('reject_order_validation', function () {

    $order = Order::create([
        'university' => 'Damas',
        'major' => 'med',
        'type' => 'grad pro',
        'description'=>'smth smth',
        'deadline'=>'1/8/2024',
        'status'=>'pending',
    ]);

    $response = $this->postJson('/api/reject_order/'.$order->id);

    $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(['message' => 'order has been rejected']);

    $this->assertDatabaseHas('orders', [
        'status' => 'rejected',
    ]);
});
