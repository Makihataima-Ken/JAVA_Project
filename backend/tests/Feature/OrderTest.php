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
    $response = $this->postJson('/api/orders/add_order', [
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
    $response = $this->deleteJson('/api/orders/cancel_order/'.$order->id);

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
    $response = $this->postJson('/api/orders/add_order',$request);


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
    $orders=Order::factory()->count(3)->create(['user_id'=>$user->id]);

    //request to see orders
    $response = $this->get('/api/orders/user_orders');

    //make sure the respone is working
    $response->assertStatus(JsonResponse::HTTP_OK)
    ->assertJson([
        'success' => true,
        'message' => 'My Orders',
        'status_message' => 'HTTP_OK',
    ]);

    // Check that the returned data matches the user's orders
    $responseData = $response->json('data');
    $this->assertCount(3, $responseData);

    foreach ($orders as $index => $order) {
        $this->assertEquals($order->id, $responseData[$index]['id']);
        $this->assertEquals($order->type, $responseData[$index]['type']);
        $this->assertEquals($order->status, $responseData[$index]['status']);
        //TODO check how to call the timestamps instances
        //$this->assertEquals($order->created_at, $responseData[$index]['creation_date']);
        
    }
});

//5th test
test('users_order_list_2', function () {

    // Create a user and authenticate
    $user = User::factory()->create();
    $this->actingAs($user);

    //test orders
    $orders=Order::factory()->count(2)->create(['user_id'=>$user->id]);
    $order2=Order::factory()->create(['user_id'=>2]);

    //request to see orders
    $response = $this->get('/api/orders/user_orders');

    //make sure the respone is working
    $response->assertStatus(JsonResponse::HTTP_OK)
    ->assertJson([
        'success' => true,
        'message' => 'My Orders',
        'status_message' => 'HTTP_OK',
    ]);

    $responseData = $response->json('data');
    $this->assertCount(2, $responseData);

    foreach ($orders as $index => $order) {
        $this->assertEquals($order->id, $responseData[$index]['id']);
        $this->assertEquals($order->type, $responseData[$index]['type']);
        $this->assertEquals($order->status, $responseData[$index]['status']);
        //$this->assertEquals($order->created_at, $responseData[$index]['creation_date']);
    }
});

//6th test
test('_order_details_test', function () {

    // Create an order 
    $order = Order::factory()->create();

    //call the api
    $response = $this->get('/api/orders/order_details/'.$order->id);

    //make sure the respone is working
    $response->assertStatus(JsonResponse::HTTP_OK)
    ->assertJson([
        'message' => 'Order Details',
        'data' =>[
            [
                'id' => $order->id,
                'university' => $order->university,
                'major' => $order->major,
                'type' => $order->type,
                'description' => $order->description,
                'deadline' => $order->deadline,
                'status' => 'pending',
                'file_path'=>$order->file_path,
            ],
        ],
    ]);


});