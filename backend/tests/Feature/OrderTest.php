<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;

uses(RefreshDatabase::class);

test('ordering', function () {
    $response = $this->postJson('/api/add_order', [
        'university' => 'Damas',
        'major' => 'med',
        'type' => 'grad pro',
        'description'=>'smth smth',
        'deadline'=>'1/8/2024',
    ]);

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
    
    $this->assertDatabaseHas('orders');
});
