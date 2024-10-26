<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

//1st test
test('order_fruition_no_file', function () {

    // Create a user and authenticate
    $user = User::factory()->create();
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
        'success'=>true,
        'message' => 'added an order',
        'data' => [
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
test('cancel_order_fruition_no_file', function () {

    // Create a user and authenticate
    $order = Order::factory()->create();

    //cancel test
    $response = $this->deleteJson('/api/cancel_order/'.$order->id);

    //make sure the respone is working
    $response->assertStatus(JsonResponse::HTTP_OK)
            ->assertJson(['message' => 'order canceled']);


});

//3rd test
test('order_fruition_with_file', function () {

    // Create a user and authenticate
    $user = User::factory()->create();
    $this->actingAs($user);

    // Simulate the storage (instead of actually writing to the disk)
    Storage::fake('public');
    
    // Create a fake file to upload
    $file=UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

    //request data
    $request= [
        'university' => 'Damas',
        'major' => 'med',
        'type' => 'grad pro',
        'description'=>'smth smth',
        'deadline'=>'2024-08-01',
        'file_path'=>$file,
    ];
    //makes a test order
    $response = $this->postJson('/api/add_order',$request);


    //make sure the respone is working
    $response->assertStatus(JsonResponse::HTTP_CREATED)
    ->assertJson([
        'success'=>true,
        'message' => 'added an order',
        'data' => [
            'university' => 'Damas',
            'major' => 'med',
            'type' => 'grad pro',
            'description'=>'smth smth',
            'deadline'=>'2024-08-01',
            'status'=>'pending',
            'file_path' => 'uploads/' . $file->hashName(),
        ],
    ]);
    //check for order's record in database
    $this->assertDatabaseHas('orders', [
        'user_id' => $user->id,
        'university' => 'Damas',
        'major' => 'med',
        'type' => 'grad pro',
        'description' => 'smth smth',
        'deadline' => '2024-08-01',
        'status' => 'pending',
        
    ]);

    // Assert that the file was stored in the expected directory (e.g., 'public/postimage')
    //Storage::disk('public')->assertExists('uploads/' . $file->hashName());
});

//4th test
test('users_order_list', function () {

    // Create a user and authenticate
    $user = User::factory()->create();
    $this->actingAs($user);

    //test orders
    $order=Order::factory()->create(['user_id'=>$user->id]);
    $order2=Order::factory()->create(['user_id'=>$user->id]);

    //request to see orders
    $response = $this->get('/api/user_orders');

    //make sure the respone is working
    $response->assertStatus(JsonResponse::HTTP_OK)
    ->assertJson([
        'message' => 'My Orders',
        'data' =>[[
            'user_id' => $user->id,
            'university' => $order->university,
            'major' => $order->major,
            'type' => $order->type,
            'description' => $order->description,
            'deadline' => $order->deadline,
            'status' => 'pending',
        ],
        [
            'user_id' => $user->id,
            'university' => $order2->university,
            'major' => $order2->major,
            'type' => $order2->type,
            'description' => $order2->description,
            'deadline' => $order2->deadline,
            'status' => 'pending',
        ],
    ],
    ]);
});

//5th test
test('users_order_list_2', function () {

    // Create a user and authenticate
    $user = User::factory()->create();
    $this->actingAs($user);

    //test orders
    $order=Order::factory()->create(['user_id'=>$user->id]);
    $order2=Order::factory()->create(['user_id'=>2]);

    //request to see orders
    $response = $this->get('/api/user_orders');

    //make sure the respone is working
    $response->assertStatus(JsonResponse::HTTP_OK)
    ->assertJson([
        'message' => 'My Orders',
        'data' =>[[
            'user_id' => $user->id,
            'university' => $order->university,
            'major' => $order->major,
            'type' => $order->type,
            'description' => $order->description,
            'deadline' => $order->deadline,
            'status' => 'pending',
        ],
    ],
    ]);
});

