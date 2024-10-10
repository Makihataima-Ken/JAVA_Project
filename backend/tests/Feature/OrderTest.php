<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;

uses(RefreshDatabase::class);

//1st test
test('order_fruition', function () {

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
