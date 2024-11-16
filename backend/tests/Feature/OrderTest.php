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

    //-----------------------------------------------
    $user = User::factory()->create();// Create a user and authenticate
    $this->actingAs($user);//imitate a logged in user
    //------------------------------------------------

    //--------------------------------------
    $request=[
        'university' => 'Damas',
        'major' => 'med',
        'type' => 'grad pro',
        'description'=>'smth smth',
        'deadline'=>'2024-08-01',
    ];
    $response = $this->postJson('/api/orders/add_order',$request);// call the api with input
    //--------------------------------------

    //--------------------------------------
    $response->assertStatus(JsonResponse::HTTP_CREATED) //make sure the respone is working
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
        ],
    ]);
    //------------------------------------------------
    $this->assertDatabaseHas('orders', [ 
        'user_id' => $user->id,
        'university' => 'Damas',
        'major' => 'med',
        'type' => 'grad pro',
        'description' => 'smth smth',
        'deadline' => '2024-08-01',
        'status' => 'pending',
        
    ]); //check for order's record in database
    //------------------------------------------------
});

//2nd test
test('cancel_order_fruition_no_file', function () {

    //---------------------------------
    $user = User::factory()->create();// Create a user and authenticate
    //---------------------------------

    //---------------------------------
    $order = Order::factory()->create(['user_id'=>$user->id]);//create a fake order
    //---------------------------------

    //---------------------------------
    $response = $this->deleteJson('/api/orders/cancel_order/'.$order->id);//call the api
    //---------------------------------

    //----------------------------------
    $response->assertStatus(JsonResponse::HTTP_OK)// make sure of the result 
            ->assertJson(['message' => 'order canceled']);
    //----------------------------------        

    ///TODO find a way to assert that database is empty
});

//3rd test
test('cancel_order_failed', function () {

    //---------------------------------
    $order = Order::factory()->create(['status'=>'in progress']);//create a fake order
    //---------------------------------

    //---------------------------------
    $response = $this->deleteJson('/api/orders/cancel_order/'.$order->id);//call the api
    //---------------------------------

    //----------------------------------
    $response->assertStatus(JsonResponse::HTTP_EXPECTATION_FAILED)// make sure of the result 
            ->assertJson(['message' => 'can not cancel order']);
    //----------------------------------        

    ///TODO find a way to assert that database is empty
});

//4th test
test('order_fruition_with_file', function () {

    //-----------------------------------------------
    $user = User::factory()->create(); // Create a user and authenticate
    $this->actingAs($user); // imitate a logged in user
    //------------------------------------------------

    //------------------------------------------------
    Storage::fake('public'); // Simulate the storage (instead of actually writing to the disk)
    //------------------------------------------------
    
    //------------------------------------------------
    $file=UploadedFile::fake()->create('document.pdf', 100, 'application/pdf'); // Create a fake file to upload
    //------------------------------------------------

    //------------------------------------------------
    $request= [ //request data
        'university' => 'Damas',
        'major' => 'med',
        'type' => 'grad pro',
        'description'=>'smth smth',
        'deadline'=>'2024-08-01',
        'file_path'=>$file,
    ];
    $response = $this->postJson('/api/orders/add_order',$request); //makes a test order
    //------------------------------------------------

    //------------------------------------------------
    $response->assertStatus(JsonResponse::HTTP_CREATED) //make sure the respone is working
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
    //------------------------------------------------

    //------------------------------------------------
    $this->assertDatabaseHas('orders', [ 
        'user_id' => $user->id,
        'university' => 'Damas',
        'major' => 'med',
        'type' => 'grad pro',
        'description' => 'smth smth',
        'deadline' => '2024-08-01',
        'status' => 'pending',
        
    ]); //check for order's record in database
    //------------------------------------------------

    // Assert that the file was stored in the expected directory (e.g., 'public/postimage')
    //Storage::disk('public')->assertExists('uploads/' . $file->hashName());
});

//5th test
test('users_order_list', function () {

    //-----------------------------------------------
    $user = User::factory()->create(); // Create a user and authenticate
    $this->actingAs($user); // imitate a logged in user
    //-----------------------------------------------

    //-----------------------------------------------
    $orders=Order::factory()->count(3)->create(['user_id'=>$user->id]); // create fake orders
    //-----------------------------------------------

    //-----------------------------------------------
    $response = $this->get('/api/orders/user_orders'); // use the api
    //-----------------------------------------------

    //-----------------------------------------------
    $response->assertStatus(JsonResponse::HTTP_OK) //make sure the respone is working
    ->assertJson([
        'success' => true,
        'message' => 'My Orders',
        'status_message' => 'HTTP_OK',
    ]);
    //-----------------------------------------------

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

//6th test
test('users_order_list_2', function () {

    //-----------------------------------------------
    $user = User::factory()->create(); // Create a user and authenticate
    $this->actingAs($user); // imitate a logged in user
    //-----------------------------------------------

    //test orders
    $orders=Order::factory()->count(2)->create(['user_id'=>$user->id]);
    $order2=Order::factory()->create();

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

//7th test
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