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

    $this->assertDatabaseHas('orders', [
        'status' => 'rejected',
    ]);
});
